<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\IClassRoomService;
use App\Http\Requests\ClassRoomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassRoomController extends Controller
{
    private $classRoomService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        IClassRoomService $classRoomService
    )
    {
        $this->classRoomService = $classRoomService;
    }

    public function index(Request $request)
    {
        $data = $this->classRoomService->filter($request->all());
        if (request()->ajax()) {
            $resultContainer = view('pages.class-room.partials._list', compact('data'))->render();
            $paginate = view('partials.paginate', ['list' => $data])->render();
            return response()->json([
                'resultContainer' => $resultContainer,
                'paginate' => $paginate
            ]);
        }
        return view('pages.class-room.index', compact('data'));
    }

    /**
     * register a new class room controller
     *
     */
    public function create()
    {
        return view('pages.class-room.create');
    }

    /**
     * post create new class room controller
     */
    public function postRegister(ClassRoomRequest $request)
    {
        $create = $this->classRoomService->createNewData($request->all());
        if ($create == false) {
            Session::flash('error', "Thêm phòng học mới thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Thêm phòng học mới thành công !");
        return redirect()->route('classroom.index');
    }

    /**
     * update class room
     */
    public function update($id)
    {
        $data = $this->classRoomService->findById($id);
        return view('pages.class-room.edit', compact('data'));
    }

    /**
     * save update classroom
     */
    public function saveUpdate(Request $request)
    {
        $update = $this->classRoomService->saveUpdate($request->all());
        if ($update == false) {
            Session::flash('error', "Sửa phòng học thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Sửa phòng học thành công !");
        return redirect()->route('classroom.index');
    }

    /**
     * delete subject object
     */
    public function delete($id)
    {
        $delete = $this->classRoomService->deleteById($id);
        if ($delete == false) {
            Session::flash('error', "Xóa phòng học thất bạt !");
            return redirect()->back();
        }
        Session::flash('success', "Xóa phòng học thành công !");
        return response()->json([]);
    }
}
