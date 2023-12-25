<?php

namespace App\Classes\Repository;

use App\Classes\Enum\TodoStatusEnum;
use App\Classes\Repository\Interfaces\ITodoRepository;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoRepository  extends BaseRepository implements ITodoRepository
{
    public function __construct(Todo $model)
    {
        parent::__construct($model);
    }

    public function getAllData()
    {
        return $this->model->whereNot('status',TodoStatusEnum::cancel->value)->paginate(20);
    }
    /**
     * @inheritDoc
     */
    public function dataFilter($data)
    {
        $todo = $this->model;
        if ($data['filter_me'] == 'true') {
            $me_id = Auth::id();
            $todo = $todo->where('manager_id', $me_id);
        }

        if ($data['manager_id']) {
            $todo = $todo->where('manager_id', $data['manager_id']);
        }

        if ($data['registrar_id']) {
            $todo = $todo->where('registrar_id', $data['registrar_id']);
        }

        if (isset($data['status'])) {
            $todo = $todo->whereIn('status', $data['status']);
        }

        if ($data['key']) {
            $todo = $todo->where('title', 'LIKE', '%' . $data['key'] . '%');
        }

        if ($data['column'] == 'name_project') {
            $todo = $todo->join('projects', 'todos.project_id', '=', 'projects.id')
                        ->orderBy('projects.name', $data['direction'])
                        ->select('todos.*');
        }else{
            $todo = $todo->orderBy($data['column'], $data['direction']);
        }

        if ($data['not_cancel'] == 'true') {
            $todo = $todo->whereNot('status',TodoStatusEnum::cancel->value);
        }

        return $todo->paginate(20);
    }
}
