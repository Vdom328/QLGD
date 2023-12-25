<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();
        $roles = Role::all();
        $index = 1;
        foreach ($roles as $role) {
            $email = $role->slug.'@user.com';
            $this->createUser($faker, $email, $role, $index);
            $index++;
        }
    }

    private function createUser($faker, $email, $role, $index)
    {
        $user = User::where('email', '=', $email)->first();
        if (null === $user) {
            $user = User::create([
                'name'                           => $role->slug,
                'email'                          => $email,
                'token'                          => str_random(64),
                'password'                       => Hash::make('password'),
                'signup_ip_address'              => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);

            $profile = new Profile();
            $profile->staff_no = "000$index";
            $profile->first_name = "first";
            $profile->last_name = "last";
            $user->profile()->save($profile);
            $user->attachRole($role);
            $user->save();
        }
    }
}
