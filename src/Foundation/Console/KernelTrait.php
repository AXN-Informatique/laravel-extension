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
     * Recherche et alias automatiquement toutes les classes modèles avec leur
     * nom pour avoir un accès rapide à ceux-ci lorsque l'on est dans Tinker.
     *
     * À appeler dans la méthode bootstrap() du Console Kernel de l'application,
     * après l'appel à parent::bootstrap().
     *
     * @return void
     */
    protected function aliasModelsIfInTinker()
    {
        if (!$this->getCurrentCommand() instanceof TinkerCommand) return;

        $appFiles  = $this->app['files']->allFiles($this->app['path']);
        $appNs     = $this->getAppNamespace();

        foreach ($appFiles as $file) {
            $name  = $file->getBasename('.php');
            $dir   = $file->getRelativePath();
            $class = $appNs.($dir ? str_replace('/', '\\', $dir).'\\' : '').$name;

            try {
                $rc = new ReflectionClass($class);

                if (!$rc->isInstantiable() || !$rc->isSubclassOf('Illuminate\Database\Eloquent\Model')) {
                    continue;
                }

                AliasLoader::getInstance()->alias($name, $class);
            }
            catch (ReflectionException $e) {}
        }
    }
}
