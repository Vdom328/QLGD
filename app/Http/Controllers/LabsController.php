<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\IClassRoomService;
use App\Classes\Services\Interfaces\ILabsService;
use App\Classes\Services\Interfaces\ISubjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LabsController extends Controller
{
    private $subjectService, $classRoomService, $labsService;

    public function __construct(
        ISubjectService $subjectService,
        IClassRoomService $classRoomService,
        ILabsService $labsService
    )
    {
        $this->subjectService = $subjectService;
        $this->classRoomService = $classRoomService;
        $this->labsService = $labsService;
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
            $resultContainer = view('pages.labs.partials._list', compact('data','labs_room'))->render();
            $paginate = view('partials.paginate', ['list' => $data])->render();
            return response()->json([
                'resultContainer' => $resultContainer,
                'paginate' => $paginate
            ]);
        }
        return view('pages.labs.index', compact('data','labs_room'));
    }

    /**
     * create a new labs room
     */
    public function create(Request $request)
    {
        $create = $this->labsService->createNewData($request->all());
        if ($create == false) {
            return response()->json();
        }
        return response()->json();
    }
}
