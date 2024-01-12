<?php

namespace App\Classes\Services\Interfaces;


interface ISchedulerService
{

    /**
     * get data schedule
     */
    public function getData($data);

    /**
     * get data schedule
     */
    public function getSchedule($data);

    /**
     * get list schedule
     */
    public function getListSchedule();

    /**
     * get schedule by user
     */
    public function getScheduleByUser($user);

    /**
     * save schedule by id
     */
    public function saveSchedule($id);
}
