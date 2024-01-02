<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\ISchedulerService;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

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

    public function index()
    {
        $schedule= $this->schedulerService->getData();
        return view('pages.scheduler.index',compact('schedule'));
    }
}
