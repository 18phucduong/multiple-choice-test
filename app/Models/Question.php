<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    use HasFactory;

    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'answer_question', 'question_id', 'answer_id');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'question_test', 'question_id', 'test_id');
    }
}
