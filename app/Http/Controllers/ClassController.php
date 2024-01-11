<?php

namespace App\Http\Controllers;

use App\Classes\Repository\Interfaces\IClassRepository;
use App\Classes\Services\Interfaces\IClassService;
use App\Http\Requests\ClassRoomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassController extends Controller
{

    private $classService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        IClassService $classService
    )
    {
        $this->classService = $classService;
    }

    public function index(Request $request)
    {
        $data = $this->classService->filter($request->all());
        if (request()->ajax()) {
            $resultContainer = view('pages.class.partials._list', compact('data'))->render();
            $paginate = view('partials.paginate', ['list' => $data])->render();
            return response()->json([
                'resultContainer' => $resultContainer,
                'paginate' => $paginate
            ]);
        }
        return view('pages.class.index', compact('data'));
    }

    /**
     * register a new class controller
     *
     */
    public function create()
    {
        return view('pages.class.create');
    }

    /**
     * post create new class  controller
     */
    public function postRegister(ClassRoomRequest $request)
    {
        $create = $this->classService->createNewData($request->all());
        if ($create == false) {
            Session::flash('error', "Thêm lớp học mới thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Thêm lớp học mới thành công !");
        return redirect()->route('class.index');
    }

    /**
     * update class
     */
    public function update($id)
    {
        $data = $this->classService->findById($id);
        return view('pages.class.edit', compact('data'));
    }

    /**
     * save update class
     */
    public function saveUpdate(Request $request)
    {
        $update = $this->classService->saveUpdate($request->all());
        if ($update == false) {
            Session::flash('error', "Sửa lớp học thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Sửa lớp học thành công !");
        return redirect()->route('class.index');
    }

    /**
     * delete subject object
     */
    public function delete($id)
    {
        $delete = $this->classService->deleteById($id);
        if ($delete == false) {
            Session::flash('error', "Xóa lớp học thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Xóa lớp học thành công !");
        return response()->json([]);
    }
}
