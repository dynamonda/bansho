<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // 1人目の管理ユーザー
        DB::table('users')->insert([
            'name' => '管理者ABC',
            'email' => 'abc@example.com',
            'password' => Hash::make('test1234'),   // Todo: 本来パスワードは隠匿する情報
        ]);

        // 2人目の管理者ユーザー
        DB::table('users')->insert([
            'name' => '管理者DEF',
            'email' => 'def@example.com',
            'password' => Hash::make('test1234'),
        ]);

        /* 以下のは古い書き方なのでなし
        User::create([
            'name' => '管理者ABC',
            'email' => 'abc@example.com',
            'password' => Hash::make('test1234'),
        ]);
        User::create([
            'name' => '管理者DEF',
            'email' => 'def@example.com',
            'password' => Hash::make('test1234'),
        ]);
        */
    }
}
