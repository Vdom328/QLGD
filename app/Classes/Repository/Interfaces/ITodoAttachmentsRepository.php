<?php

namespace App\Classes\Repository\Interfaces;

interface ITodoAttachmentsRepository extends IBaseRepository
{
    /**
     * delete by todo_id
     * @param int $id
     */
    public function deleteByTodoId($todo_id);
}
