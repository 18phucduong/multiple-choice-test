<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tests = Test::factory(4)
        ->has(
            Question::factory(5)
            ->hasAttached(
                Answer::factory()->count(10),
                ['is_true' => 0]
            )
        )
        ->create();
        foreach( $tests as $test ) {
            $this->randomTrueAnswerOfQuestions($test->questions, 3);
        }
    }

    function randomTrueAnswerOfQuestions($questions, $trueAnswersNumber) {
        foreach( $questions as $question ) {
            $answers = $question->answers;
            $trueAnswers = $answers->random($trueAnswersNumber);

            foreach( $trueAnswers as $answer ) {
                DB::table('answer_question')
                    ->where('question_id', $question->id)
                    ->where('answer_id',$answer->id)
                    ->update(['is_true' => 1]);
            }
        }
    }
}
