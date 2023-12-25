<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IProjectRelatedFileRepository;
use App\Models\ProjectRelatedFile;

class ProjectRelatedFileRepository extends BaseRepository implements IProjectRelatedFileRepository
{
    public function __construct(ProjectRelatedFile $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function insertRelatedFilesByProject($data, $projectId): void
    {
        $dataRelatedFiles = [];
        foreach ($data as $value) {
            if ($value !== '') {
                $dataRelatedFiles[] = [
                    'project_id' => $projectId,
                    'url' => $value
                ];
            }
        }
        $this->insert($dataRelatedFiles);
    }

    /**
     * @inheritdoc
     */
    public function updateRelatedFilesByProject($data, $projectId): void
    {
        $this->removeRelatedFilesByUrlProject($projectId);
        if (!empty($data['related_files'])) {
            $this->insertRelatedFilesByProject($data['related_files'], $projectId);
        }
    }

    /**
     * @inheritdoc
     */
    public function removeRelatedFilesByUrlProject($projectId)
    {
        return $this->model
            ->where('project_id', $projectId)
            ->delete();
    }
}
