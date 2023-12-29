<?php

namespace App\Classes\Repository\Interfaces;

interface ISubjectRepository extends IBaseRepository
{
    public function exists($subject_no);
    public function filter($data);
}
