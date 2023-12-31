<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\ISubjectService;
use App\Classes\Services\Interfaces\ITeacherSubjectService;
use App\Classes\Services\Interfaces\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherSubjectController extends Controller
{
    protected $userService,$subjectService,$teacherSubjectService;

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
        $teacher_subject = $this->teacherSubjectService->finByTeacherId($id);
        return view('pages.teacher-subject.edit',compact('teacher','subject','teacher_subject'));
    }

    /**
     * create a new teacher subject
     */
    public function create(Request $request)
    {
        $create = $this->teacherSubjectService->createNewData($request->all());
        if ($create == false) {
            Session::flash('error', "Chỉnh sửa thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Chỉnh sửa thành công !");
        return redirect()->route('teacherSubject.index');
    }
}
