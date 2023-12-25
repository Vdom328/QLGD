<?php

namespace App\Classes\Services;

use App\Classes\Enum\TodoStatusEnum;
use App\Classes\Repository\Interfaces\ITodoAttachmentsRepository;
use App\Classes\Repository\Interfaces\ITodoRepository;
use App\Classes\Services\Interfaces\ITodoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement UserService
 */
class TodoService extends BaseService implements ITodoService
{
    private $todoRepository, $todoAttachmentsRepository;

    public function __construct(
        ITodoRepository $todoRepository,
        ITodoAttachmentsRepository $todoAttachmentsRepository
    ) {
        $this->todoRepository = $todoRepository;
        $this->todoAttachmentsRepository = $todoAttachmentsRepository;
    }

    /**
     * @inheritDoc
     */
    public function createData($data)
    {
        DB::beginTransaction();
        try {
            $attrTodo = [
                "type" => $data['type'],
                "title" => $data['title'],
                "content" => $data['content'],
                "status" => TodoStatusEnum::new->value,
                "expired_date" => $data['expired_date'],
                "manager_id" => $data['manager_id'],
                "registrar_id" => $data['registrar_id'],
                "project_id" => $data['project_id'],
            ];
            $todo = $this->todoRepository->create($attrTodo);
            //create todo attachment
            if (isset($data['attachments']) && ($data['attachments'] != '' || $data['attachments'] != null)) {
                $this->insertAttachment($data['attachments'], $todo->id);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create todo: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getAllData()
    {
        return $this->todoRepository->getAllData();
    }

    /**
     * @inheritDoc
     */
    public function findById($id)
    {
        return $this->todoRepository->findById($id);
    }

    /**
     * @inheritDoc
     */
    public function saveUpdate($data, $id)
    {
        DB::beginTransaction();
        try {
            $todo = $this->todoRepository->findById($id);
            $attrTodo = [
                "type" => $data['type'],
                "title" => $data['title'],
                "content" => $data['content'],
                "status" => $data['status'],
                "expired_date" => $data['expired_date'],
                "manager_id" => $data['manager_id'],
                "registrar_id" => $data['registrar_id'],
                "project_id" => $data['project_id'],
            ];
            $todoUpdate = $this->todoRepository->update($todo,$attrTodo);
            //create todo attachment
            if (isset($data['attachments']) && ($data['attachments'] != '' || $data['attachments'] != null)) {
                $todoAttachment = $this->todoAttachmentsRepository->deleteByTodoId($id);
                $this->insertAttachment($data['attachments'], $id);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while update todo: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function insertAttachment($data, $todo_id)
    {
        $attrTodoAttachment = [];
        foreach ($data as $attachment) {
            $extension = $attachment->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $attachment->storeAs('public/todo_attachments', $filename);
            $attrTodoAttachment[] = [
                'todo_id' => $todo_id,
                'filename' => $filename,
            ];
        }
        $this->todoAttachmentsRepository->insert($attrTodoAttachment);
        return true;
    }


    /**
     * @inheritDoc
     */
    public function dataFilter($data)
    {
        return $this->todoRepository->dataFilter($data);
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $deleteTodoManager = $this->todoAttachmentsRepository->deleteByTodoId($id);
            $deleteTodo = $this->todoRepository->deleteById($id);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while delete todo: ' . $e->getMessage());
            return false;
        }
    }
}
