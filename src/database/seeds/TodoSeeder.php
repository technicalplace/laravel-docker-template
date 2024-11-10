<?php

use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 該当のテーブルのレコードをすべて削除する
        DB::table('todos')->truncate();

        // テストデータを用意
        $testData = [
            [
                'content' => 'PHP Appセクションを終える',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'Laravel Lessonを終える',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // todosテーブルへ投入する処理
        DB::table('todos')->insert($testData);
    }
}
