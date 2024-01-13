<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'name'        => 'admin',
                'slug'        => 'admin',
                'description' => 'admin',
                'level'       => 1,
            ],
            [
                'name'        => 'teacher',
                'slug'        => 'teacher',
                'description' => 'teacher',
                'level'       => 2,
            ],
            [
                'name'        => 'student',
                'slug'        => 'student',
                'description' => 'student',
                'level'       => 3,
            ],
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = Role::where('slug', '=', $RoleItem['slug'])->first();
            if (null === $newRoleItem) {
                $newRoleItem = Role::create([
                    'name'        => $RoleItem['name'],
                    'slug'        => $RoleItem['slug'],
                    'description' => $RoleItem['description'],
                    'level'       => $RoleItem['level'],
                ]);
            }
        }
    }
}
