<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->hasTasks(rand(5, 10))
            ->count(rand(10, 20))
            ->create();

        $user = User::find(1);
        $user->role = 'admin';
        $user->email = 'admin@example.com';
        $user->save();
    }
}
