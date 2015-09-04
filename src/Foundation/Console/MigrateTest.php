<?php

namespace Axn\Illuminate\Foundation\Console;

use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MigrateTest extends Command
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'migrate:test';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Tests migrate/seed commands';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
        $testingDbConn = $this->option('conn');
        $defaultDbConn = $this->laravel['db']->getName();

        try {
            $this->laravel['db']->getConfig($testingDbConn); // Pour lever une exception si la connexion n'est pas configurée
            $this->laravel['db']->setDefaultConnection($testingDbConn);

            $this->info('> Running "migrate" command:');
            $this->call('migrate');
            echo "\n";

            $this->info('> Running "db:seed" command:');
            $this->call('db:seed');
            echo "\n";

            $this->info('> Running "migrate:reset" command:');
            $this->call('migrate:reset');
            echo "\n";

            $this->info('Completed!');
        }
        catch (Exception $e) {
            $this->info('Exception catched:');
            $this->comment($e->getMessage());
        }

        $this->laravel['db']->setDefaultConnection($defaultDbConn);
	}

    /**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			//['example', InputArgument::REQUIRED, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['conn', null, InputOption::VALUE_OPTIONAL, 'DB connection to use', 'testing'],
		];
	}
}
