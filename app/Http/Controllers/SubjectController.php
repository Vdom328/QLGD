<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\ISubjectService;
use App\Http\Requests\SubjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{

    private $subjectService;

    public function __construct(ISubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function index(Request $request)
    {
        $data = $this->subjectService->filter($request->all());
        if (request()->ajax()) {
            $resultContainer = view('pages.subject.partials._list', compact('data'))->render();
            $paginate = view('partials.paginate', ['list' => $data])->render();
            return response()->json([
                'resultContainer' => $resultContainer,
                'paginate' => $paginate
            ]);
        }
        return view('pages.subject.index', compact('data'));
    }

    /**
     * create a new subject object
     */
    public function create()
    {
        return view('pages.subject.create');
    }

    /**
     * radom the subject
     */
    public function radomNo()
    {
        $credits_no = $this->subjectService->randomNo();
        return response()->json([
            'credits_no' => $credits_no,
        ]);
    }

    /**
     * save new subject object
     */
    public function saveCreate(SubjectRequest $request)
    {
        $create = $this->subjectService->createNewData($request->all());
        if ($create == false) {
            Session::flash('error', "Thêm môn học mới thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Thêm môn học mới thành công !");
        return redirect()->route('subject.index');
    }

    /**
     * update existing subject object
     */
    public function update($id)
    {
        $data = $this->subjectService->findById($id);
        return view('pages.subject.edit', compact('data'));
    }

    /**
     * save update subject object
     */
    public function saveUpdate(Request $request)
    {
        $update = $this->subjectService->saveUpdate($request->all());
        if ($update == false) {
            Session::flash('error', "Sửa môn học thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Sửa môn học thành công !");
        return redirect()->route('subject.index');
    }

    /**
     * delete subject object
     */
    public function delete($id)
    {
        $delete = $this->subjectService->deleteById($id);
        if ($delete == false) {
            Session::flash('error', "Xóa môn học thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Xóa môn học thành công !");
        return response()->json([]);
    }
}
