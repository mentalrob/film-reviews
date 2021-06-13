<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            "email" => "admin@admin.com",
            "name" => "Administrator",
            "password" => Hash::make("123456")
        ]);
        $admin->roles()->attach(1);

        User::factory()->count(5)->create();
    }
}
