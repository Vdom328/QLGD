<?php

namespace App\Classes\Repository\Interfaces;

interface IUserRepository extends IBaseRepository
{
    /**
     * Filter staff records based on the provided data.
     *
     * @param mixed $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function filterStaffs($data);


    /**
     * Sort staffs based on the specified column and direction.
     *
     * @param string $column    The column to sort by.
     * @param string $direction The sorting direction (asc or desc).
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function sortStaffs($column, $direction);

    public function getListStaffs($data);
}
