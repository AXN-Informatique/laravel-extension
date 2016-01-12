<?php

namespace Axn\Illuminate\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Axn\Illuminate\Foundation\Console\OptimizeAll;
use Axn\Illuminate\Foundation\Console\OptimizeClear;

class ArtisanServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * The commands to be registered.
	 *
	 * @var array
	 */
	protected $commands = [
		'OptimizeAll'   => 'command.optimize.all',
		'OptimizeClear' => 'command.optimize.clear',
	];

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		foreach (array_keys($this->commands) as $command) {
			$method = "register{$command}Command";

			call_user_func_array([$this, $method], []);
		}

		$this->commands(array_values($this->commands));
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerOptimizeAllCommand()
	{
		$this->app->singleton('command.optimize.all', function() {
			return new OptimizeAll;
		});
	}

	/**
	 * Register the command.
	 *
	 * @return void
	 */
	protected function registerOptimizeClearCommand()
	{
		$this->app->singleton('command.optimize.clear', function() {
			return new OptimizeClear;
		});
	}
}
