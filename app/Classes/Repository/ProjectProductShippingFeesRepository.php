<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IProjectProductShippingFeesRepository;
use App\Models\Project;
use App\Models\ProjectProductShippingFees;

class ProjectProductShippingFeesRepository extends BaseRepository implements IProjectProductShippingFeesRepository
{
    public function __construct(ProjectProductShippingFees $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function insertByProject($data, $projectId): void
    {
        $dataInsert = [
            'project_id' => $projectId,
            'name' => $data['name'],
            'fees' => $data['fees'],
        ];
        $this->create($dataInsert);
    }

    /**
     * @inheritdoc
     */
    public function updateByProject($data, Project $project): void
    {
        $projectProductMemos = $project->projectProductShippingFees;
        if (!empty($data['data_shipping_fees_products_est'])) {
            if ($projectProductMemos->count() > 0) {
                $dataUpdate = $data['data_shipping_fees_products_est'];
                /* Update */
                $this->model
                    ->where('project_id', $project->id)
                    ->update([
                        'name' => $dataUpdate['name'],
                        'fees' => $dataUpdate['fees'],
                    ]);
            } else {
                /* Add it if the project doesn't have it initially */
                $this->insertByProject($data['data_shipping_fees_products_est'], $project->id);
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
