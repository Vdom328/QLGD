<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\ISchedulerService;
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

    public function index()
    {
        $user= Auth()->user();
        $data = $this->schedulerService->getScheduleByUser($user);
        return view('pages.schedule-user.index', compact('user', 'data'));
    }
}
