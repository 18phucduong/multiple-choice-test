<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamps = false;
    protected $fillable = ['content'];

    use HasFactory;

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'answer_question', 'answer_id', 'question_id');
    }
}

