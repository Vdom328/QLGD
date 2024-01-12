<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\ISchedulerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SchedulerController extends Controller
{
    private $schedulerService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function __construct(
        ISchedulerService $schedulerService,
    ) {
        $this->schedulerService = $schedulerService;
    }

    public function index(Request $request)
    {
        $schedule = $this->schedulerService->getSchedule($request->all());
        $list_schedule = $this->schedulerService->getListSchedule();
        // Kiểm tra và hiển thị kết quả
        if (request()->ajax()) {
            $resultContainer = view('pages.scheduler.partials._table', compact('schedule'))->render();
            return response()->json([
                'resultContainer' => $resultContainer,
            ]);
        }
        return view('pages.scheduler.index' , compact('schedule','list_schedule'));
    }

    /**
     * create a new scheduler
     */
    public function createNew(Request $request)
    {
        $schedule= $this->schedulerService->getData($request->all());

        if ($schedule == false) {
            return response()->json([]);
        }

        $resultContainer = view('pages.scheduler.partials._table', compact('schedule'))->render();
        return response()->json([
            'resultContainer' => $resultContainer,
        ]);
    }

    /**
     * save schedule information
     * @param int $id
     */
    public function saveSchedule($id)
    {
        $update = $this->schedulerService->saveSchedule($id);
        if ($update == false) {
            Session::flash('error', "Một lỗi đã xảy ra. Vui lòng thử lại !");
            return redirect()->back();
        }
        Session::flash('success', "Chỉnh sửa thành công !");
        return redirect()->route('scheduler.index');
    }
}
