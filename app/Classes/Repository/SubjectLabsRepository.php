<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ISubjectLabsRepository;
use App\Models\SubjectLabs;

class SubjectLabsRepository  extends BaseRepository implements ISubjectLabsRepository
{
    public function __construct(SubjectLabs $model)
    {
        parent::__construct($model);
    }


}
