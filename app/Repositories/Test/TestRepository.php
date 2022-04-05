<?php

namespace App\Repositories\Test;

use App\Models\Test;
use App\Repositories\RepositoryAbstract;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TestRepository extends RepositoryAbstract implements TestRepositoryInterface
{
	public function __construct(Test $test)
	{
		$this->model = $test;
	}
}
