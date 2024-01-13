<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\ISchedulerService;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleUserController extends Controller
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
        $user= Auth()->user();
        $data = $this->schedulerService->getScheduleByUser($user);
        $list_user = User::where('status', 1)->get();
        if (request()->ajax()) {
            $user = User::where('id', $request->user_id)->first();
            $data = $this->schedulerService->getScheduleByUser($user);
            $resultContainer = view('pages.schedule-user.partials._table', compact('data'))->render();
            return response()->json([
                'resultContainer' => $resultContainer,
            ]);
        }
        return view('pages.schedule-user.index', compact('user', 'data','list_user'));
    }
}
