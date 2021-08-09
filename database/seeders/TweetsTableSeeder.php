<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザーを全件取得
        $users = User::all()->random(10);
        foreach($users as $user)
        {
            $tweet = [
                'user_id' => $user->id,
                'comment' => 'こんにちは。'.$user->name.'です。よろしくお願いします。',
                'created_at' => now(),
                'updated_at' => now()
            ];

            // 挿入
            DB::table('tweets')->insert($tweet);
        }
    }
}
