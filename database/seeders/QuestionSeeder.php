<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::factory(20)
        ->hasAttached(
            Answer::factory()->count(10),
            ['is_true' => 0]
        )
        ->create();

        foreach( $questions as $question ) {
            $answers = $question->answers;
            $trueAnswers = $answers->random(3);

            foreach( $trueAnswers as $answer ) {
                DB::table('answer_question')
                    ->where('question_id', $question->id)
                    ->where('answer_id',$answer->id)
                    ->update(['is_true' => 1]);
            }
        }

    }
}
