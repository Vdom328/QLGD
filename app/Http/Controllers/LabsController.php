<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\IClassRoomService;
use App\Classes\Services\Interfaces\ISubjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class LabsController extends Controller
{
    private $subjectService, $classRoomService;

    public function __construct(
        ISubjectService $subjectService,
        IClassRoomService $classRoomService
    )
    {
        $this->subjectService = $subjectService;
        $this->classRoomService = $classRoomService;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $data['labs'] = 'true';
        $data = $this->subjectService->filter($data);
        $dataLabs = [
            'status' => Config::get('const.status.yes'),
            'paginate' => 'false',
        ];
        $labs_room = $this->classRoomService->filter($dataLabs);
        if (request()->ajax()) {
            $resultContainer = view('pages.subject.partials._list', compact('data','labs_room'))->render();
            $paginate = view('partials.paginate', ['list' => $data])->render();
            return response()->json([
                'resultContainer' => $resultContainer,
                'paginate' => $paginate
            ]);
        }
        return view('pages.labs.index', compact('data','labs_room'));
    }
}
