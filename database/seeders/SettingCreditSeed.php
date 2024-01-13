<?php

namespace Database\Seeders;

use App\Models\SettingCredits;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingCreditSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting= [
            [
                'quantity_credits'        => 1,
                'subject_weekly_max'        => 1,
                'subject_day_max'        => 1,
            ],
            [
                'quantity_credits'        => 2,
                'subject_weekly_max'        => 4,
                'subject_day_max'        => 2,
            ],
            [
                'quantity_credits'        => 3,
                'subject_weekly_max'        => 6,
                'subject_day_max'        => 3,
            ],
            [
                'quantity_credits'        => 4,
                'subject_weekly_max'        => 8,
                'subject_day_max'        => 4,
            ],
        ];

        SettingCredits::insert($setting);
    }
}
