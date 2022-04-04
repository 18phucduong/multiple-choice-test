<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;
    public function test()
    {
        return $this->belongsToMany(Test::class,'test_id', 'id');
    }
    protected $table = 'user_test_result';
}
