<?php

namespace App\Classes\Services\Interfaces;

use App\Http\Requests\RequestUser;
use Illuminate\Http\RedirectResponse;

interface IUserService
{
    /**
     * Get a list of all staffs.
     *
     * @return \Illuminate\Database\Eloquent\Collection A collection of all staffs.
     */
    public function getListStaffs($data);

    /**
     * Filter staffs based on the given data.
     *
     * @param array $data An array of data used to filter staffs.
     * @return \Illuminate\Database\Eloquent\Collection A collection of staffs that match the given data.
     */
    public function filterStaffs($data);

    /**
     * Find a staff by their ID.
     *
     * @param int $id The ID of the staff to find.
     * @return \Illuminate\Database\Eloquent\Model|null The staff with the given ID, or null if not found.
     */
    public function finById($id);

    /**
     * Sort staffs by the given column in the given direction.
     *
     * @param string $column The name of the column to sort by.
     * @param string $direction The direction to sort by (either 'asc' or 'desc').
     * @return \Illuminate\Database\Eloquent\Collection The staffs sorted by the given column in the given direction.
     */
    public function sortStaffs($column, $direction);

    public function getListUser();

    public function getUserByEmail($email);
}
