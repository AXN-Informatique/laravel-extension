<?php

namespace Axn\Illuminate\Database\Eloquent;

// En complément de \Illuminate\Database\Eloquent\Model
trait ModelTrait
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

    /**
     * Crée plusieurs nouveaux enregistrements.
     *
     * @param  array[array] $attributesList
     * @return void
     */
    public static function createMany(array $attributesList)
    {
        $model = new static;

        if ($model->usesTimestamps()) {
            $now = $model->freshTimestampString();

            foreach ($attributesList as &$attributes) {
                $attributes[$model->getCreatedAtColumn()] = $now;
                $attributes[$model->getUpdatedAtColumn()] = $now;
            }
        }

        static::query()->getQuery()->insert($attributesList);
    }
}
