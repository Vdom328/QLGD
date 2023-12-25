<?php

namespace App\Http\Controllers;

use App\Classes\Enum\TodoStatusEnum;
use App\Classes\Services\Interfaces\IProjectService;
use App\Classes\Services\Interfaces\ITodoService;
use App\Classes\Services\Interfaces\IUserService;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{

    protected $todoService, $userService, $projectService;

    public function __construct(
        ITodoService $todoService,
        IUserService $userService,
        IProjectService $projectService
    ) {
        $this->todoService = $todoService;
        $this->userService = $userService;
        $this->projectService = $projectService;
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            $todo = $this->todoService->dataFilter($request->all());
            $resultContainer = view('pages.todo.partials._list', compact('todo'))->render();
            $paginate = view('partials.paginate', ['list' => $todo])->render();
            return response()->json([
                'resultContainer' => $resultContainer,
                'paginate' => $paginate
            ]);
        }
        $users = $this->userService->getListUser();
        $todo = $this->todoService->getAllData();
        $statusValues = $this->getStatus();
        return view('pages.todo.index',compact('todo','statusValues','users'));
    }


    /**
     * register todo list
     */
    public function register()
    {
        $users = $this->userService->getListUser();
        $status = TodoStatusEnum::new;
        return view('pages.todo.register', compact('users','status'));
    }

    /** create todo
     *
     */
    public function createTodo(TodoRequest $request)
    {
        $create = $this->todoService->createData($request->all());
        if ($create == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "Todoの作成に成功しました !");
        return response()->json([
            'url' => Route('todo.index'),
        ]);
    }

    /**
     * get project
     */
    public function getProject(request $request)
    {
        if ( $request->staff_id == '') {
            return response()->json([
                'project' => '',
            ]);
        }
        $project = $this->projectService->getByStaffId($request->staff_id, $request->key);
        $project_list = view('pages.todo.partials._table_project', compact('project'))->render();
        return response()->json([
            'project_list' => $project_list,
        ]);
    }

    /**
     * get update todo by id
     */
    public function update($id)
    {
        $todo = $this->todoService->findById($id);
        $users = $this->userService->getListUser();
        return view('pages.todo.edit',compact('todo','users'));
    }

    public function saveUpdate(TodoRequest $request, $id)
    {
        $update = $this->todoService->saveUpdate($request->all(), $id);
        if ($update == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "Todoの作成に成功しました !");
        return response()->json([
            'url' => Route('todo.index'),
        ]);
    }

    /**
     * Get status default in project
     */
    public function getStatus(): array
    {
        $statusValues = [];
        $statusCases = TodoStatusEnum::cases();
        foreach ($statusCases as $status) {
            $statusValues[] = [
                'value' => $status->value,
                'name' => TodoStatusEnum::getLabel($status->value)
            ];
        }
        return $statusValues;
    }

    /**
     * delete todo by id
     * @param int $id
     */
    public function delete($id)
    {
        $delete = $this->todoService->delete($id);
        if ($delete == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "Todo が正常に削除されました !");
        return redirect()->route('todo.index');
    }
}
