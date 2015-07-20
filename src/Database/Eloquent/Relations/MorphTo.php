<?php

namespace Axn\Illuminate\Database\Eloquent\Relations;

use ReflectionClass;
use Illuminate\Database\Eloquent\Relations\MorphTo as BaseMorphTo;

class MorphTo extends BaseMorphTo
{
    /**
	 * Crée une nouvelle instance du modèle via le type, en ajoutant au préalable
     * le namespace des modèles à celui-ci.
	 *
	 * @param  string  $type
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function createModelByType($type)
	{
        $class = (new ReflectionClass($this->getParent()))->getNamespaceName().'\\'.$type;

        return new $class;
	}
}
