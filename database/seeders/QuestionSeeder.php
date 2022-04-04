<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Arr;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::factory(20)
        ->hasAttached(
            Answer::factory()->count(10),
            ['is_true' => 0]
        )
        ->create();
    }
}
