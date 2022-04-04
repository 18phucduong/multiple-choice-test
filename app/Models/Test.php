<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_test', 'test_id', 'question_id');
    }
    public function testResults()
    {
        return $this->hasMany(TestResult::class,'test_id', 'id');
    }
}
