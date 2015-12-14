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
     * @return string|array|null
     */
    public function getOrderBy()
    {
        return isset($this->orderBy) ? $this->orderBy : null;
    }

    /**
     * Crée plusieurs nouveaux enregistrements en une requête grâce à la méthode
     * insert() du QueryBuilder en prenant soin de renseigner les champs "created_at"
     * et "updated_at" de chaque enregistrement avant insertion.
     *
     * ATTENTION : Cette méthode ne déclenche pas les évènements et ne fait aucun
     * retour !
     *
     * @param  array[array] $data
     * @return void
     */
    public static function createMany(array $data)
    {
        $model = new static;

        if ($model->usesTimestamps()) {
            $now = $model->freshTimestampString();

            foreach ($data as &$attributes) {
                $attributes[$model->getCreatedAtColumn()] = $now;
                $attributes[$model->getUpdatedAtColumn()] = $now;
            }
        }

        static::query()->getQuery()->insert($data);
    }
}
