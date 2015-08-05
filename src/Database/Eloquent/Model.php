<?php

namespace Axn\Illuminate\Database\Eloquent;

//use Illuminate\Database\Eloquent\Model as BaseModel;

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
}
