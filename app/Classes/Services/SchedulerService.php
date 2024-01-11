<?php

namespace App\Classes\Services;

use App\Classes\Enum\RoleUserEnum;
use App\Classes\Enum\StaffStatusEnum;
use App\Classes\Repository\Interfaces\IClassRoomRepository;
use App\Classes\Repository\Interfaces\IScheduleErrorRepository;
use App\Classes\Repository\Interfaces\IScheduleRepository;
use App\Classes\Repository\Interfaces\IScheduleTableRepository;
use App\Classes\Repository\Interfaces\ISubjectLabsRepository;
use App\Classes\Repository\Interfaces\ISubjectRepository;
use App\Classes\Repository\Interfaces\IUserRepository;
use App\Classes\Services\Interfaces\ISchedulerService;
use App\Classes\Services\Interfaces\IUserService;
use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\ScheduleTable;
use App\Models\SettingCredits;
use App\Models\StudentSubject;
use Carbon\Carbon;
use App\Models\TeacherSubject;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement UserService
 */
class SchedulerService implements ISchedulerService
{
    private $subjectRepository, $classRoomRepository, $userRepository, $scheduleRepository, $scheduleTableRepository, $scheduleErrorRepository;

    public function __construct(
        ISubjectRepository $subjectRepository,
        IClassRoomRepository $classRoomRepository,
        IUserRepository $userRepository,
        IScheduleRepository $scheduleRepository,
        IScheduleTableRepository $scheduleTableRepository,
        IScheduleErrorRepository $scheduleErrorRepository
    ) {
        $this->subjectRepository = $subjectRepository;
        $this->classRoomRepository = $classRoomRepository;
        $this->userRepository = $userRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->scheduleTableRepository = $scheduleTableRepository;
        $this->scheduleErrorRepository = $scheduleErrorRepository;
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

    public function getData($data)
    {
        $days = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
        // $days = ['Thứ 2', 'Thứ 3', 'Thứ 4'];
        $time_slots = range(1, time_slots());
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
                if ($subject->subject->avoid_first_lesson == Config::get('const.status.yes')) {

                    // radom phòng học
                    $shuffledRooms = $class_rooms->toArray();
                    shuffle($shuffledRooms);
                    foreach ($shuffledRooms as $room_id) {
                        $room_id = $room_id['id'];
                        // thêm tkb
                        $this->themTKB($schedule, $checkDay, $subject_weekly_count, $subject, $quantityCredits, $time_slots, $day, $room_id, $subject_total_credits_added);
                        break;
                    }
                }
            }
        }

        // sắp xếp để lấy giảng viên đăng kí sớm nhất trước
        //  lấy ra nhwuxng $subject có giảng viên đăng kí ưu tiên
        $subjectsWithTimeSlots = $subjects->filter(function ($subject) {
            return isset($subject->teacher->teacher_time_slots) && $subject->teacher->teacher_time_slots->count() >= 1;
        });
        $subjectsArray = $subjectsWithTimeSlots->values()->toArray();
        // Sort $subjectsArray array using an inline comparison function
        usort($subjectsArray, function ($a, $b) {
            $timeSlotsA = collect($a['teacher']['teacher_time_slots'])->min('created_at');
            $timeSlotsB = collect($b['teacher']['teacher_time_slots'])->min('created_at');

            return strtotime($timeSlotsA) - strtotime($timeSlotsB);
        });
        // thêm những môn học được giáo viên chọn để ưu tiên
        foreach ($subjectsArray as $subject) {
            if (isset($subject->teacher->teacher_time_slots) && $subject->teacher->teacher_time_slots->count() >= 1) {
                $shuffledDays = $days;
                shuffle($shuffledDays);
                foreach ($shuffledDays as $day) {
                    //lấy ra số lượng tiết trong ngày hôm đó và số tiết trogn 1 tuần
                    $quantityCredits = $this->check_quantity_credits($subject);

                    // Thêm môn học ưu tiên có tiết đầu

                    // radom phòng học
                    $shuffledRooms = $class_rooms->toArray();
                    shuffle($shuffledRooms);
                    foreach ($shuffledRooms as $room_id) {
                        $room_id = $room_id['id'];
                        // thêm tkb
                        if ($subject_weekly_count[$subject->id] < $quantityCredits['subject_weekly_max']) {

                            foreach ($subject->teacher->teacher_time_slots as $item) {
                                $i = $item->time_slot;
                                $isAvailable = true;
                                for ($j = 0; $j < count($time_slots); $j++) {

                                    // không được trùng lớp
                                    if (isset($checkDay[$day][$i + $j]) && $checkDay[$day][$i + $j]['class'] === $subject->id) {
                                        $isAvailable = false;
                                        continue 2;
                                    }
                                    // không được trùng giáo viên
                                    if (isset($checkDay[$day][$i + $j]) && ($checkDay[$day][$i + $j]['teacher'] === $subject->teacher_id || $checkDay[$day][$i + $j]['class'] === $subject->id)) {
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

                                    break;
                                }
                            }
                        }
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

                    $this->themTKB($schedule, $checkDay, $subject_weekly_count, $subject, $quantityCredits, $time_slots, $day, $room_id, $subject_total_credits_added);
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
                    $this->themTKB($schedule, $checkDay, $subject_weekly_count, $subject, $quantityCredits, $time_slots, $day, $room_id, $subject_total_credits_added);
                }
            }
        }

        // Lặp lại lần nữa tránh sót tiết
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
                    $this->themTKB($schedule, $checkDay, $subject_weekly_count, $subject, $quantityCredits, $time_slots, $day, $room_id, $subject_total_credits_added);
                }
            }
        }
        $missing_credits_subjects = $this->checkMissingCredits($subject_total_credits_added);

        // create db
        $create = $this->createNewData($data, $schedule, $missing_credits_subjects);

        if ($create == false) {
            return false;
        }

        return $this->getSchedule(['id' => $create]);
    }


    /**
     * lưu thời khóa biểu
     */
    public function themTKB(&$schedule, &$checkDay, &$subject_weekly_count, $subject, $quantityCredits, $time_slots, $day, $room_id, &$subject_total_credits_added)
    {
        if ($subject_weekly_count[$subject->id] < $quantityCredits['subject_weekly_max']) {

            for ($i = 1; $i <= count($time_slots) - 1; $i++) {
                $isAvailable = true;
                for ($j = 0; $j < count($time_slots); $j++) {

                    // không được trùng lớp
                    if (isset($checkDay[$day][$i + $j]) && $checkDay[$day][$i + $j]['class'] === $subject->id) {
                        $isAvailable = false;
                        continue 2;
                    }
                    // không được trùng giáo viên
                    if (isset($checkDay[$day][$i + $j]) && ($checkDay[$day][$i + $j]['teacher'] === $subject->teacher_id || $checkDay[$day][$i + $j]['class'] === $subject->id)) {
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

                    break;
                }
            }
        }
    }

    /**
     * Kiểm tra xem số tiết liên tiếp có trống cho tất cả phòng học hay không.
     */
    function kiemTraKhoangTrong(&$schedule, $day, $start_slot, $class_room_id, $subject_day_max)
    {
        for ($slot_offset = 0; $slot_offset < $subject_day_max; $slot_offset++) {
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
                'cl' => $subject->color,
                'teacher_subjects_id' => $subject->id
            ];
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

        $data = SettingCredits::where('quantity_credits', $subject->subject->quantity_credits)->first();

        $subject_weekly_max =  $data->subject_weekly_max;
        $subject_day_max = $data->subject_day_max;;

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
                $missing_credits = $quantityCredits['subject_weekly_max'];
                $missing_credits_subjects[$subject_id] = 'Môn: ' . $subject->subject->name . ', Lớp:' . $subject->class . ' Bị thiếu ' . $missing_credits . ' tiết';
                continue;
            }

            if ($subject_total_credits_added[$subject_id] < $quantityCredits['subject_weekly_max']) {
                $missing_credits = $quantityCredits['subject_weekly_max'] - $subject_total_credits_added[$subject_id];
                $missing_credits_subjects[$subject_id] = 'Môn: ' . $subject->subject->name . ', Lớp:' . $subject->class . ' Bị thiếu ' . $missing_credits . ' tiết';
            }
        }

        return $missing_credits_subjects;
        // $missing_credits_subjects chứa thông tin về môn học bị thiếu tiết
        // Bạn có thể xử lý thông tin này theo nhu cầu của mình
        // Ví dụ: xuất thông báo, gửi email thông báo, v.v.
    }


    /**
     * create a new db instance
     * @param array $data
     * @param array $schedule
     */
    public function createNewData($data, $schedule, $missing_credits_subjects)
    {
        DB::beginTransaction();
        try {
            // create db schedule
            $attr = [
                'name' => $data['name']
            ];
            $create_schedule = $this->scheduleRepository->create($attr);

            // create db schedule table
            $attr_table = [];
            foreach ($schedule as $day => $value) {

                foreach ($value as $time_slots => $item) {

                    foreach ($item as $class_room_id => $array) {

                        if (isset($array['teacher_subjects_id'])) {
                            $attr_table[] = [
                                'schedule_id' => $create_schedule->id,
                                'day' => $day,
                                'time_slots' => $time_slots,
                                'class_room_id' => $class_room_id,
                                'teacher_subjects_id' => $array['teacher_subjects_id'],
                            ];
                        }
                    }
                }
            }
            $create_schedule_table = $this->scheduleTableRepository->insert($attr_table);

            // create schedule error
            $attr_error = [];
            foreach ($missing_credits_subjects as $key => $error) {
                $attr_error[] = [
                    'schedule_id' => $create_schedule->id,
                    'error' => $error
                ];
            }
            $create_schedule_table = $this->scheduleErrorRepository->insert($attr_error);


            DB::commit();

            return $create_schedule->id;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create new schedule: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getSchedule($data)
    {
        $id = '';
        if (isset($data['id'])) {
            $id = $data['id'];
            $schedule  = Schedule::where('id', $data['id'])->with('schedule_table', 'schedule_error')->first();
        } else {
            $schedule = Schedule::where('status', Config::get('const.status.yes'))->first();
            if (!isset($schedule)) {
                $schedule = Schedule::latest()->with('schedule_table', 'schedule_error')->first();
            }
        }
        // Khởi tạo mảng kết quả rỗng

        $days = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
        // $days = ['Thứ 2', 'Thứ 3', 'Thứ 4'];
        $time_slots = range(1, time_slots());
        $class_rooms = $this->getClassRooms();
        $result = $this->getSchedules($days, $time_slots, $class_rooms);

        if ($schedule && $schedule->schedule_table) {
            // Lấy thông tin từ schedule_table của schedule
            $tableData = $schedule->schedule_table;

            foreach ($tableData as $data) {
                // $class_rooms[$data->class_room_id] =  [
                //     'id' => $data->class_room_id,
                //     'name' => ClassRoom::where('id', $data->class_room_id)->first()->name
                // ];

                $day = $data->day;
                $timeSlots = $data->time_slots;
                $classRoomId = $data->class_room_id;
                $teacherSubjectsId = $data->teacher_subjects_id;
                $subject = TeacherSubject::where('id', $teacherSubjectsId)->first();
                // Tạo cấu trúc mảng theo ý muốn
                $result[$day][$timeSlots][$classRoomId] = [
                    'ten_mon_hoc' => $subject->subject->name,
                    'lop' => $subject->class,
                    'gv' => $subject->teacher->profile->full_name,
                    'cl' => $subject->color,
                ];
            }
        }
        return [
            'class_rooms' => $class_rooms,
            'schedule' => $result,
            'schedule_error' => $schedule['schedule_error'] ?? '',
            'id' => $schedule->id
        ];
    }

    /**
     * @inheritDoc
     */
    public function getListSchedule()
    {
        return $this->scheduleRepository->find([]);
    }

    /**
     * @inheritDoc
     */
    public function getScheduleByUser($user)
    {
        $schedule  = Schedule::latest()->with('schedule_table', 'schedule_error')->first();

        $userSubjectIds =  [];

        if ($user->level() == RoleUserEnum::STAFF->value) {
            $user_subjects = TeacherSubject::where('teacher_id', $user->id)->get();
            $userSubjectIds = $user_subjects->pluck('id')->toArray();
        }

        if ($user->level() == RoleUserEnum::STUDENT->value) {
            $user_subjects = StudentSubject::where('student_id', $user->id)->get();
            $userSubjectIds = $user_subjects->pluck('teacher_subject_id')->toArray();
        }

        $schedule = ScheduleTable::where('schedule_id', $schedule->id)->whereIn('teacher_subjects_id', $userSubjectIds)->with('teacher_subject')->get();

        // Khởi tạo mảng kết quả rỗng
        $days = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'];
        $time_slots = range(1, time_slots());
        $result = [];
        foreach ($days as $day) {
            foreach ($time_slots as $time_slot) {
                $result[$day][$time_slot] = [];
            }
        }
        foreach ($days as $day) {
            foreach ($time_slots as $time_slot) {
                $schedule_users = $schedule->where('day', $day)->where('time_slots', $time_slot);
                if ($schedule_users->count() > 0) {
                    foreach ($schedule_users as $schedule_user) {
                        $result[$day][$time_slot][$schedule_user->class_room->name]= [
                            'ten_mon_hoc' => $schedule_user->teacher_subject->subject->name ?? '',
                            'lop' => $schedule_user->teacher_subject->class ?? '',
                            'phong' => $schedule_user->class_room->name ?? '',
                            'cl' => $schedule_user->teacher_subject->color ?? '',
                            'gv' => $schedule_user->teacher_subject->teacher->profile->full_name ?? '',
                        ];
                    }
                }

            }
        }
        return $result;
    }
}
