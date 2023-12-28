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
}
