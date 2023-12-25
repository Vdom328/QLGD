<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ITodoAttachmentsRepository;
use App\Models\TodoAttachments;

class TodoAttachmentsRepository  extends BaseRepository implements ITodoAttachmentsRepository
{
    public function __construct(TodoAttachments $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function deleteByTodoId($todo_id)
    {
        return $this->model->where('todo_id', $todo_id)->delete();
    }
}
