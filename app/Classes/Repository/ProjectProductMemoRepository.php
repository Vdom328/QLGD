<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IProjectProductMemoRepository;
use App\Models\Project;
use App\Models\ProjectProductMemo;

class ProjectProductMemoRepository extends BaseRepository implements IProjectProductMemoRepository
{
    public function __construct(ProjectProductMemo $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function insertByProject($dataMemoProductsEst, $projectId): void
    {

        $dataInsert = [
            'project_id' => $projectId,
            'memo' => $dataMemoProductsEst,
            'order' => 1
        ];
        $this->create($dataInsert);
    }

    /**
     * @inheritdoc
     */
    public function updateByProject($data, Project $project): void
    {
        $projectProductMemos = $project->projectProductMemos;
        if (!empty($data['data_memo_products_est'])) {
            if ($projectProductMemos->count() > 0) {
                /* Update */
                $this->model
                    ->where('project_id', $project->id)
                    ->update(['memo' => $data['data_memo_products_est']]);
            } else {
                /* Add it if the project doesn't have it initially */
                $this->insertByProject($data['data_memo_products_est'], $project->id);
            }
        } else {
            /* Delete all */
            if ($projectProductMemos->count() > 0) {
                $this->model
                    ->where('project_id', $project->id)
                    ->delete();
            }
        }
    }
}
