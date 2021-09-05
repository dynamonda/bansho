<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザーを全件取得
        $users = User::all();
        foreach ($users as $user) {
            // 2〜4件を追加
            $count = rand(2, 4);
            for ($i = 0; $i < $count; $i++) {
                $note = [
                    'user_id' => $user->id,
                    'title' => 'No.' . $i + 1 . ' ノート',
                    'body' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                // 挿入
                DB::table('notes')->insert($note);
            }
        }
    }
}
