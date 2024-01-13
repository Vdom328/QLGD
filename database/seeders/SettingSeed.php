<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting= [
            [
                'time_slots'        => 11,
                'paginate'        => 20,
            ],
        ];

        Settings::insert($setting);
    }
}
