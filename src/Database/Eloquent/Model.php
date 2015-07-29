<?php

namespace Axn\Illuminate\Database\Eloquent;

use ReflectionClass;
//use Illuminate\Database\Eloquent\Model as BaseModel;
use Axn\Illuminate\Database\Eloquent\Relations\MorphTo;

trait Model /*extends BaseModel*/
{
    /**
     * Retourne une nouvelle instance du builder d'Eloquent.
     *
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Axn\Illuminate\Database\Eloquent\Builder
     */
    public function newEloquentBuilder($query)
    {
        // Axn\Illuminate\Database\Eloquent\Builder
        return new Builder($query);
    }

    /**
     * Définit l'inverse d'une relation polymorphique en prenant en compte le fait
     * que le morph type ne contient pas le namespace du modèle.
     *
     * @param  string  $name
     * @param  string  $type
     * @param  string  $id
     * @return \Axn\Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function morphTo($name = null, $type = null, $id = null)
    {
        if (is_null($name)) {
            list(, $caller) = debug_backtrace(false);

            $name = snake_case($caller['function']);
        }

        list($type, $id) = $this->getMorphs($name, $type, $id);

        if (is_null($class = $this->$type)) {
            // Axn\Illuminate\Database\Eloquent\Relations\MorphTo
            return new MorphTo(
                $this->newQuery(), $this, $id, null, $type, $name
            );
        } else {
            $class = (new ReflectionClass($this))->getNamespaceName().'\\'.$class;
            $instance = new $class;

            // Axn\Illuminate\Database\Eloquent\Relations\MorphTo
            return new MorphTo(
                with($instance)->newQuery(), $this, $id, $instance->getKeyName(), $type, $name
            );
        }
    }

    /**
     * Retourne le nom de classe pour la relation polymorphique.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return $this->morphClass ?: class_basename($this);
    }
}
