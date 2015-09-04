<?php

namespace Axn\Illuminate\Foundation\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\View\Engines\CompilerEngine;

class OptimizeAll extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'optimize:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs all optimization commands';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('clear-compiled');

        $this->call('optimize', ['--force' => true]);

        $this->call('config:cache');

        $this->call('route:cache');

        $this->compileViews();
    }

    /**
	 * Compile all view files.
	 *
	 * @return void
	 */
	protected function compileViews()
	{
        $this->info('Compiling views');

		foreach ($this->laravel['view']->getFinder()->getPaths() as $path) {
			foreach ($this->laravel['files']->allFiles($path) as $file) {
				try {
					$engine = $this->laravel['view']->getEngineFromPath($file);
				}
				catch (\InvalidArgumentException $e) {
					continue;
				}

				if ($engine instanceof CompilerEngine) {
					$engine->getCompiler()->compile($file);
				}
			}
		}
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
			//['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}
}
