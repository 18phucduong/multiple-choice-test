<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Test::factory(4)
        ->has(
            Question::factory(20)
            ->hasAttached(
                Answer::factory()->count(10),
                ['is_true' => 0]
            )
        )
        ->create();
    }
}
