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

    public function test()
    {
        return $this->belongsToMany(Test::class);
    }
}
