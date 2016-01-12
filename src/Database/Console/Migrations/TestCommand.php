<?php

namespace Axn\Illuminate\Database\Console\Migrations;

use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TestCommand extends Command
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
        $testingDbConn = $this->option('database');
        $defaultDbConn = $this->laravel['db']->getName();

        try {
            $this->laravel['db']->getConfig($testingDbConn); // Pour lever une exception si la connexion n'est pas configurée
            $this->laravel['db']->setDefaultConnection($testingDbConn);

            $this->comment('> Running "migrate" command:');
            $this->call('migrate');
            echo "\n";

            if ($this->option('seed')) {
                $this->comment('> Running "db:seed" command:');
                $this->call('db:seed');
                echo "\n";
            }

            $this->comment('> Running "migrate:reset" command:');
            $this->call('migrate:reset');
            echo "\n";

            $this->info('Completed!');
        }
        catch (Exception $e) {
            $this->error('Exception catched: '.$e->getMessage());
            $this->line($e->getTraceAsString());
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
			['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.', 'testing'],
            ['seed', null, InputOption::VALUE_NONE, 'Indicates if the seed task should be run.'],
		];
	}
}
