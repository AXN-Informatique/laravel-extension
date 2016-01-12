<?php

namespace Axn\Illuminate\Database;

use Illuminate\Support\ServiceProvider;
use Axn\Illuminate\Database\Console\Migrations\TestCommand;

class MigrationServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCommands();
	}

	/**
	 * Register all of the migration commands.
	 *
	 * @return void
	 */
	protected function registerCommands()
	{
		$commands = ['Test'];

		// We'll simply spin through the list of commands that are migration related
		// and register each one of them with an application container. They will
		// be resolved in the Artisan start file and registered on the console.
		foreach ($commands as $command) {
			$this->{'register'.$command.'Command'}();
		}

		// Once the commands are registered in the application IoC container we will
		// register them with the Artisan start event so that these are available
		// when the Artisan application actually starts up and is getting used.
		$this->commands(
			'command.migrate.test'
		);
	}

	/**
	 * Register the "test" migration command.
	 *
	 * @return void
	 */
	protected function registerTestCommand()
	{
		$this->app->singleton('command.migrate.test', function($app) {
			return new TestCommand;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'command.migrate.test',
		];
	}
}
