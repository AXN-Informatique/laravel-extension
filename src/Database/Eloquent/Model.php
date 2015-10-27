<?php

namespace Axn\Illuminate\Database\Eloquent;

//use Illuminate\Database\Eloquent\Model as BaseModel;

trait Model /*extends BaseModel*/
{
    /**
     * Retourne une nouvelle instance du builder d'Eloquent.
     *
     * @param  \Illuminate\Database\Query\Builder $query
     * @return Builder
     */
    public function newEloquentBuilder($query)
    {
        // Axn\Illuminate\Database\Eloquent\Builder
        return new Builder($query);
    }

    /**
     * Retourne la valeur de l'attribut $orderBy si celui-ci a été défini.
     *
     * @return array|null
     */
    public function getOrderBy()
    {
        return isset($this->orderBy) ? $this->orderBy : null;
    }
}
