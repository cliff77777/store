<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use Str;
use Illuminate\Database\Eloquent\Factories\Factory;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(1)->create([
            'name' => "管理員",
            'email' => "admin@example.com",
            'email_verified_at' => now(),
            'type' => "a",
            'password' => Hash::Make('123456'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
