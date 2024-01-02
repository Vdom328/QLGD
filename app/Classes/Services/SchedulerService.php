<?php

namespace App\Classes\Services;

use App\Classes\Enum\StaffStatusEnum;
use App\Classes\Repository\Interfaces\IClassRoomRepository;
use App\Classes\Repository\Interfaces\ISubjectLabsRepository;
use App\Classes\Repository\Interfaces\ISubjectRepository;
use App\Classes\Repository\Interfaces\IUserRepository;
use App\Classes\Services\Interfaces\ISchedulerService;
use App\Classes\Services\Interfaces\IUserService;
use Carbon\Carbon;
use App\Models\TeacherSubject;
use Illuminate\Support\Facades\Config;

/**
 * Implement UserService
 */
class SchedulerService implements ISchedulerService
{
    private $subjectRepository, $classRoomRepository, $userRepository;

    public function __construct(
        ISubjectRepository $subjectRepository,
        IClassRoomRepository $classRoomRepository,
        IUserRepository $userRepository
    ) {
        $this->subjectRepository = $subjectRepository;
        $this->classRoomRepository = $classRoomRepository;
        $this->userRepository = $userRepository;
    }

    private function getClassRooms()
    {
        return $this->classRoomRepository->filter([
            'status' => Config::get('const.status.yes'),
            'paginate' => 'false'
        ]);
    }

    private function getSubjects()
    {
        return TeacherSubject::all();
    }

    private function getSchedules($days, $time_slots, $class_rooms)
    {
        $schedule = [];
        foreach ($days as $day) {
            foreach ($time_slots as $time_slot) {
                foreach ($class_rooms as $class_room) {
                    $schedule[$day][$time_slot][$class_room->id] = '';
                }
            }
        }
        return $schedule;
    }

    /**
     * @inheritDoc
     */

    public function getData()
    {
        // $days = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
        $days = ['Thứ 2', 'Thứ 3', 'Thứ 4'];
        $time_slots = range(1, 11);
        $class_rooms = $this->getClassRooms();
        $subjects = $this->getSubjects();
        $schedule = $this->getSchedules($days, $time_slots, $class_rooms);
        $subject_weekly_count = array_fill_keys(array_column($subjects->toArray(), 'id'), 0);
        $checkDay = [];
        $subject_total_credits_added = [];; // Mảng lưu thông tin môn học không được thêm vào thời khóa biểu

        // thêm những môn học được chỉ định học tiết đầu
        foreach ($subjects as $subject) {
            $shuffledDays = $days;
            shuffle($shuffledDays);
            foreach ($shuffledDays as $day) {
            //lấy ra số lượng tiết trong ngày hôm đó và số tiết trogn 1 tuần
            $quantityCredits = $this->check_quantity_credits($subject);

                // Thêm môn học ưu tiên có tiết đầu
                if ($subject->subject->avoid_first_lesson == Config::get('const.status.yes') ) {

                    // radom phòng học
                    $shuffledRooms = $class_rooms->toArray();
                    shuffle($shuffledRooms);
                    foreach ($shuffledRooms as $room_id) {
                        $room_id = $room_id['id'];
                        // thêm tkb
                        $this->themTKB($schedule ,$checkDay, $subject_weekly_count, $subject, $quantityCredits, $time_slots, $day, $room_id,$subject_total_credits_added);
                        break;
                    }

                }
            }
        }

        // thêm những môn học được chỉ định học phòng nào
        foreach ($subjects as $subject) {
            $shuffledDays = $days;
            shuffle($shuffledDays);
            foreach ($shuffledDays as $day) {
            //lấy ra số lượng tiết trong ngày hôm đó và số tiết trogn 1 tuần
            $quantityCredits = $this->check_quantity_credits($subject);

                // Thêm môn học ưu tiên có phòng học chỉ định vào thời khóa biểu
                if ($subject->subject->require_class_room == Config::get('const.status.yes') && isset($subject->subject->subject_labs)) {

                    $room_id = $subject->subject->subject_labs->class_room_id;

                    $this->themTKB($schedule ,$checkDay, $subject_weekly_count, $subject, $quantityCredits, $time_slots, $day, $room_id,$subject_total_credits_added);
                }
            }
        }

        // thêm những môn học còn lại
        foreach ($subjects as $subject) {
            $shuffledDays = $days;
            shuffle($shuffledDays);
            foreach ($shuffledDays as $day) {
            //lấy ra số lượng tiết trong ngày hôm đó và số tiết trogn 1 tuần
            $quantityCredits = $this->check_quantity_credits($subject);

                // // radom phòng học
                $shuffledRooms = $class_rooms->toArray();
                shuffle($shuffledRooms);
                foreach ($shuffledRooms as $room_id) {
                    $room_id = $room_id['id'];
                    // thêm tkb
                    $this->themTKB($schedule ,$checkDay, $subject_weekly_count, $subject, $quantityCredits, $time_slots, $day, $room_id,$subject_total_credits_added);
                }
            }
        }
        $missing_credits_subjects = $this->checkMissingCredits($subject_total_credits_added);
        return [
            'class_rooms' => $class_rooms,
            'days' => $days,
            'time_slots' => $time_slots,
            'schedule' => $schedule,
            'missing_credits_subjects' => $missing_credits_subjects
        ];
    }


    /**
     * lưu thời khóa biểu
     */
    public function themTKB(&$schedule ,&$checkDay, &$subject_weekly_count, $subject, $quantityCredits, $time_slots, $day, $room_id, &$subject_total_credits_added)
    {
        if ($subject_weekly_count[$subject->id] < $quantityCredits['subject_weekly_max']) {

            for ($i = 1; $i <= count($time_slots) - 1 ; $i++) {
                $isAvailable = true;
                for ($j = 0; $j < count($time_slots); $j++) {

                    // không được trùng lớp
                    if (isset($checkDay[$day][$i + $j]) && $checkDay[$day][$i + $j]['class'] === $subject->id) {
                        $isAvailable = false;
                        continue 2;
                    }
                    // không được trùng giáo viên
                    if (isset($checkDay[$day][$i + $j]) && ( $checkDay[$day][$i + $j]['teacher'] === $subject->teacher_id || $checkDay[$day][$i + $j]['class'] === $subject->id )) {
                        $isAvailable = false;
                        continue 2;
                    }

                }
                // Kiểm tra xem số tiết này đã trống chưa
                if ($isAvailable && $this->kiemTraKhoangTrong($schedule, $day, $i, $room_id, $quantityCredits['subject_day_max'])) {
                    $this->ganMonHoc($schedule, $day, $i, $room_id, $subject, $quantityCredits['subject_day_max']);
                    $subject_weekly_count[$subject->id] += $quantityCredits['subject_day_max'];

                    for ($j = 0; $j < $quantityCredits['subject_day_max']; $j++) {
                        $checkDay[$day][$i + $j]['class'] = $subject->class;
                        $checkDay[$day][$i + $j]['teacher'] = $subject->teacher_id;
                    }
                    if (!isset($subject_total_credits_added[$subject->id])) {
                        $subject_total_credits_added[$subject->id] = 0;
                    }
                    $subject_total_credits_added[$subject->id] += $quantityCredits['subject_day_max'];

                    break ;
                }
            }
        }
    }

    /**
     * Kiểm tra xem số tiết liên tiếp có trống cho tất cả phòng học hay không.
     */
    function kiemTraKhoangTrong(&$schedule, $day, $start_slot, $class_room_id, $subject_day_max)
    {
        for ($slot_offset = 0; $slot_offset < $subject_day_max ; $slot_offset++) {
            if (!isset($schedule[$day][$start_slot + $slot_offset])) {
                return false;
            }
            if ($schedule[$day][$start_slot + $slot_offset][$class_room_id] !== '') {
                return false;
            }
        }
        return true;
    }

    /**
     * Gán môn học vào số tiết đã chọn cho tất cả các phòng học.
     */
    function ganMonHoc(&$schedule, $day, $start_slot, $class_room_id, $subject, $subject_day_max)
    {
        for ($slot_offset = 0; $slot_offset < $subject_day_max; $slot_offset++) {
            if (!$schedule[$day][$start_slot + $slot_offset]) {
                return false;
            }
            $schedule[$day][$start_slot + $slot_offset][$class_room_id] = [
                'ten_mon_hoc' => $subject->subject->name,
                'lop' => $subject->class,
                'gv' => $subject->teacher->profile->full_name,
                'cl' => $subject->color
            ] ;
        }
        return $schedule;
    }

    /**
     * check quantity for schedule
     */
    private function check_quantity_credits($subject)
    {
        $subject_weekly_max = 1;
        $subject_day_max = 1;

        if ($subject->subject->quantity_credits == 3) {
            $subject_weekly_max = 6;
            $subject_day_max = 3;
        } elseif ($subject->subject->quantity_credits == 2) {
            $subject_weekly_max = 4;
            $subject_day_max = 2;
        }

        if ($subject->subject->block >  $subject_day_max) {
            $subject_day_max = $subject->subject->block;
        }

        return [
            'subject_weekly_max' => $subject_weekly_max,
            'subject_day_max' => $subject_day_max,
        ];
    }

    public function checkMissingCredits($subject_total_credits_added)
    {
        $subjects = $this->getSubjects();

        $missing_credits_subjects = [];
        foreach ($subjects as $subject) {
            $subject_id = $subject->id;
            $quantityCredits = $this->check_quantity_credits($subject);

            if (!isset($subject_total_credits_added[$subject_id])) {
                $missing_credits = $quantityCredits['subject_weekly_max'] ;
                $missing_credits_subjects[$subject_id] = 'Môn: ' . $subject->subject->name . ', Lớp:' . $subject->class . ' Bị thiếu ' . $missing_credits .' tiết';
                continue;
            }

            if ($subject_total_credits_added[$subject_id] < $quantityCredits['subject_weekly_max']) {
                $missing_credits = $quantityCredits['subject_weekly_max'] - $subject_total_credits_added[$subject_id];
                $missing_credits_subjects[$subject_id] = 'Môn: ' . $subject->subject->name . ', Lớp:' . $subject->class . ' Bị thiếu ' . $missing_credits .' tiết';
            }
        }

        return $missing_credits_subjects;
        // $missing_credits_subjects chứa thông tin về môn học bị thiếu tiết
        // Bạn có thể xử lý thông tin này theo nhu cầu của mình
        // Ví dụ: xuất thông báo, gửi email thông báo, v.v.
    }

}
