<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザーを全件取得
        $users = DB::table('users')->get();
        foreach($users as $user)
        {
            $profile = [
                'user_id' => $user->id,
                'comment' => '私は'.$user->name.'です。よろしくお願いします。',
                'created_at' => now(),
                'updated_at' => now()
            ];

            // 挿入
            DB::table('profiles')->insert($profile);
        }
    }
}
