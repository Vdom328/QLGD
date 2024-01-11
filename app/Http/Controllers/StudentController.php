<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\IStudentSubjectService;
use App\Classes\Services\Interfaces\ISubjectService;
use App\Classes\Services\Interfaces\ITeacherSubjectService;
use App\Classes\Services\Interfaces\IUserService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $userService, $teacherSubjectService, $studentSubjectService;

    public function __construct(
        IUserService $userService,
        ITeacherSubjectService $teacherSubjectService,
        IStudentSubjectService $studentSubjectService
    ) {
        $this->userService = $userService;
        $this->teacherSubjectService = $teacherSubjectService;
        $this->studentSubjectService = $studentSubjectService;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $data['student'] = 'true';
        $data = $this->userService->filter($data);
        if (request()->ajax()) {
            $resultContainer = view('pages.student.partials._list', compact('data'))->render();
            $paginate = view('partials.paginate', ['list' => $data])->render();
            return response()->json([
                'resultContainer' => $resultContainer,
                'paginate' => $paginate
            ]);
        }
        return view('pages.student.index', compact('data'));
    }

    /**
     * edit a teacher subject
     */
    public function update($id)
    {
        $student = $this->userService->finById($id);
        $subject = $this->teacherSubjectService->filter(['paginate' => 'false']);
        $data = $this->studentSubjectService->finByStudentId($id);
        return view('pages.student.edit', compact('student', 'subject','data'));
    }


    /**
     * create subject createSubject
     */
    public function createSubject(Request $request)
    {

        $create = $this->studentSubjectService->createNew($request->all());
        $data = $this->studentSubjectService->finByStudentId($request->student_id);
        $resultContainer = view('pages.student.partials._list-subject', compact('data'))->render();
        return response()->json([
            'resultContainer' => $resultContainer,
        ]);
    }

    /**
     * delete a subject
     */
    public function delete($id)
    {
        $delete = $this->studentSubjectService->delete($id);
        if ($delete == false) {
            return response()->json([ ]);
        }
        return response()->json([ ]);
    }
}
