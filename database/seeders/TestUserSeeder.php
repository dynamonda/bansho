<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run()
    {
        // 100件のテストユーザーを登録する
        for($cnt = 1; $cnt <= 100; $cnt++)
        {
            DB::table('users')->insert([
                'name' => 'テストユーザー' . $cnt,
                'email' => 'test' . $cnt . '@example.com',
                'password' => Hash::make('testtest'),
            ]);
        }
    }
}
