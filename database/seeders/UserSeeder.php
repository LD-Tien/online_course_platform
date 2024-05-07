<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        foreach (UserRole::getValues() as $role) {
            for ($i = 0; $i < 2; $i++) {
                User::create([
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail,
                    'password' => '123123123',
                    'role' => $role,
                    'email_verified_at' => now(),
                ]);
            }
        }
    }
}
