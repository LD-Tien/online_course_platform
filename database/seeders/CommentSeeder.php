<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('user_comment')->insert([
            [
                'id' => 1,
                'parent_comment_id' => null,
                'user_id' => 10,
                'quiz_id' => null,
                'lesson_id' => 1801581534025185,
                'content' => 'This is the first comment on lesson 501.',
                'created_at' => Carbon::create('2024', '06', '01', '10', '00', '00'),
                'updated_at' => Carbon::create('2024', '06', '01', '10', '00', '00'),
            ],
            [
                'id' => 2,
                'parent_comment_id' => 1,
                'user_id' => 8,
                'quiz_id' => null,
                'lesson_id' => 1801581534025185,
                'content' => 'Replying to the first comment.',
                'created_at' => Carbon::create('2024', '06', '01', '10', '05', '00'),
                'updated_at' => Carbon::create('2024', '06', '01', '10', '05', '00'),
            ],
            [
                'id' => 3,
                'parent_comment_id' => 1,
                'user_id' => 10,
                'quiz_id' => null,
                'lesson_id' => 1801581534025185,
                'content' => 'New comment on the same lesson as before.',
                'created_at' => Carbon::create('2024', '06', '03', '12', '00', '00'),
                'updated_at' => Carbon::create('2024', '06', '03', '12', '00', '00'),
            ],
            [
                'id' => 4,
                'parent_comment_id' => null,
                'user_id' => 8,
                'quiz_id' => null,
                'lesson_id' => 1801581534025185,
                'content' => 'New comment on the same lesson as before.',
                'created_at' => Carbon::create('2024', '06', '03', '12', '00', '00'),
                'updated_at' => Carbon::create('2024', '06', '03', '12', '00', '00'),
            ]
        ]);
    }
}
