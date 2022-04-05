<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
	protected $repositories = [
		'Test',
		'Question',
        'Answer'
	];

	protected $repositoryPath = "App\Repositories";
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        // $q =  new \App\Repositories\Test\TestRepository;
		// dd($q);
        foreach ($this->repositories as $repository) {

			app()->singleton(
				"{$this->repositoryPath}\\$repository\\{$repository}RepositoryInterface",
				"{$this->repositoryPath}\\$repository\\{$repository}Repository",
			);
		}
	}
}
