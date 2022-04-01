<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::factory()
            ->hasTasks(10)
            ->count(20)
            ->create();

        $user = User::find(1);
        $user->email = 'edik-kichaev@yandex.ru';
        $user->role = 'admin';
        $user->save();
    }
}
