<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    public function run()
    {
        // 100件のテストユーザーを登録する
        User::factory()->count(100)->create();
    }
}
