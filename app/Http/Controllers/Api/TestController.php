<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestResult;

use App\Repositories\Test\TestRepositoryInterface;



class TestController extends Controller
{
    public function __construct(
       protected TestRepositoryInterface $testRepository
    ){

    }
    public function show($id) {
        $test = $this->testRepository->find($id);

        return response()->json([
            'test' => $test
        ]);

    }
    public function list() {

    }
    public function store(Test $test) {

    }
    public function delete(Test $test) {

    }
    public function save(TestResult $testResult) {

    }

}
