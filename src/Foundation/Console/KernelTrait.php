<?php

namespace Axn\Illuminate\Foundation\Console;

use ReflectionClass, ReflectionException;
use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Console\TinkerCommand;
use Symfony\Component\Console\Input\ArgvInput;

// En complément de \Illuminate\Foundation\Console\Kernel
trait KernelTrait
{
    use AppNamespaceDetectorTrait;

    /**
     * Retourne l'instance de la commande courante.
     *
     * @return \Illuminate\Console\Command|null
     */
    protected function getCurrentCommand()
    {
        if (!$name = (new ArgvInput)->getFirstArgument()) return null;

        return $this->getArtisan()->find($name);
    }

	/**
     * Alias les classes modèles avec leur nom pour un accès rapide à ceux-ci
     * lorsque l'on est dans Tinker.
     *
     * @param  string $modelsDir
     * @return void
     */
    protected function aliasModelsIfInTinker($modelsDir = '')
    {
        if (!$this->getCurrentCommand() instanceof TinkerCommand) return;

        $modelsFiles = $this->app['files']->allFiles(app_path($modelsDir));

        $modelsNs = $this->getAppNamespace()
                    .($modelsDir ? str_replace('/', '\\', $modelsDir).'\\' : '');

        foreach ($modelsFiles as $file) {
            $name  = $file->getBasename('.php');
            $dir   = $file->getRelativePath();
            $class = $modelsNs.($dir ? str_replace('/', '\\', $dir).'\\' : '').$name;

            try {
                $rc = new ReflectionClass($class);

                if (!$rc->isInstantiable()
                    || !$rc->isSubclassOf('Illuminate\Database\Eloquent\Model'))
                    continue;

                AliasLoader::getInstance()->alias($name, $class);
            }
            catch (ReflectionException $e) {}
        }
    }
}
