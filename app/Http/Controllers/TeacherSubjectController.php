<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\ISubjectService;
use App\Classes\Services\Interfaces\ITeacherSubjectService;
use App\Classes\Services\Interfaces\IUserService;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\TeacherTimeSlots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class TeacherSubjectController extends Controller
{
    protected $userService, $subjectService, $teacherSubjectService;

    public function __construct(
        IUserService $userService,
        ISubjectService $subjectService,
        ITeacherSubjectService $teacherSubjectService
    ) {
        $this->userService = $userService;
        $this->subjectService = $subjectService;
        $this->teacherSubjectService = $teacherSubjectService;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $data['teacher'] = 'true';
        $data = $this->userService->filter($data);
        if (request()->ajax()) {
            $resultContainer = view('pages.teacher-subject.partials._list', compact('data'))->render();
            $paginate = view('partials.paginate', ['list' => $data])->render();
            return response()->json([
                'resultContainer' => $resultContainer,
                'paginate' => $paginate
            ]);
        }
        return view('pages.teacher-subject.index', compact('data'));
    }

    /**
     * edit a teacher subject
     */
    public function update($id)
    {
        $teacher = $this->userService->finById($id);
        $subject = $this->subjectService->filter(['paginate' => 'false']);
        $data = $this->teacherSubjectService->finByTeacherId($id);
        $teacher_time_slots = TeacherTimeSlots::where('teacher_id', $id)->get();
        $class = ClassModel::where('status', Config::get('const.status.yes'))->get();
        return view('pages.teacher-subject.edit', compact('teacher', 'subject', 'data','teacher_time_slots', 'class'));
    }

    /**
     * create a new teacher subject
     */
    public function create(Request $request)
    {
        $create = $this->teacherSubjectService->createNewData($request->all());
        if ($create == false) {
            return response()->json([ ]);
        }
        return response()->json([ ]);
    }

    /**
     * create subject createSubject
     */
    public function createSubject(Request $request)
    {
        $create = $this->teacherSubjectService->createNew($request->all());
        $data = $this->teacherSubjectService->finByTeacherId($request->teacher_id);
        $class = ClassModel::where('status', Config::get('const.status.yes'))->get();
        $resultContainer = view('pages.teacher-subject.partials._list-subject', compact('data','class'))->render();
        return response()->json([
            'resultContainer' => $resultContainer,
        ]);
    }

    /**
     * delete a subject
     */
    public function delete($id)
    {
        $delete = $this->teacherSubjectService->delete($id);
        if ($delete == false) {
            return response()->json([ ]);
        }
        return response()->json([ ]);
    }

    /**
     * create time slot
     */
    public function createTimeSlots(Request $request)
    {
        $create = $this->teacherSubjectService->createTimeSlots($request->all());
        if ($create == false) {
            Session::flash('error', "Thêm tiết học ưu tiên thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Thêm tiết học ưu tiên thành công !");
        return redirect()->route('teacherSubject.update', $request->teacher_id);
    }
}
