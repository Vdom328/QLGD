<?php

namespace App\Classes\Repository\Interfaces;

interface IProjectRepository
{
    /**
     * Filter project
     */
    public function filter($dataFilter);
    public function getByStaffId($staff_id,$key);

    public function searchAndFilter($request);

    public function getProjectByCompanyId($id);
}

