<?php

namespace Axn\Illuminate\Database\Eloquent;

use Exception;
use Illuminate\Database\Eloquent\Builder as BaseEloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\MorphOneOrMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Builder extends BaseEloquentBuilder
{
    /**
     * Nom du trait utilisé par le modèle pour les soft deletes.
     */
    const SOFT_DELETES_TRAIT = 'Illuminate\Database\Eloquent\SoftDeletes';

    /**
     * Liste des modèles liés à la table (incluant celui de la table dans le "from").
     *
     * @var array[\Axn\Illuminate\Database\Eloquent\Model]
     */
    protected $relatedModels = [];

    /**
     * Modifie l'alias de la table utilisée dans la clause "from".
     *
     * @param  string $alias
     * @return \Axn\Illuminate\Database\Eloquent\Builder
     */
    public function alias($alias)
    {
        $table = $this->model->getTable();
        $this->model->setTable($alias);

        $query = $this->model->newQuery();
        $query->from("$table as $alias");

        return $query;
    }

    /**
     * Construit et enregistre une clause "join" en utilisant la relation définie
     * sur le modèle, à l'instar de la méthode with().
     *
     * @param  string  $relationName
     * @param  string  $alias
     * @param  string  $type
     * @param  boolean $withTrashed
     * @return \Axn\Illuminate\Database\Eloquent\Builder
     */
    public function joinRel($relationName, $alias = '', $type = 'inner', $withTrashed = false)
    {
        $this->parseRelationName($relationName, $parentAlias);
        $alias = $alias ?: $relationName;

        if (!isset($this->relatedModels[$alias])) {
            $relation = $this->relatedModels[$parentAlias]->$relationName();
            $this->relatedModels[$alias] = $relation->getRelated();

            $table = $relation->getRelated()->getTable()." as $alias";
            $relation->getRelated()->setTable($alias);
            $relation->getParent()->setTable($parentAlias);

            $cond = $this->buildCond($relation, $withTrashed);

            $this->query->join($table, $cond, null, null, $type);
        }

        return $this;
    }

    /**
     * Idem méthode joinRel() mais en incluant les enregistrements supprimés.
     *
     * @param  string  $relationName
     * @param  string  $alias
     * @param  string  $type
     * @return \Axn\Illuminate\Database\Eloquent\Builder
     */
    public function joinRelWithTrashed($relationName, $alias = '', $type = 'inner')
    {
        return $this->joinRel($relationName, $alias, $type, true);
    }

    /**
     * Idem méthode joinRel() mais en type LEFT.
     *
     * @param  string  $relationName
     * @param  string  $alias
     * @param  boolean $withTrashed
     * @return \Axn\Illuminate\Database\Eloquent\Builder
     */
    public function leftJoinRel($relationName, $alias = '', $withTrashed = false)
    {
        return $this->joinRel($relationName, $alias, 'left', $withTrashed);
    }

    /**
     * Idem méthode leftJoinRel() mais en incluant les enregistrements supprimés.
     *
     * @param  string $relationName
     * @param  string $alias
     * @return \Axn\Illuminate\Database\Eloquent\Builder
     */
    public function leftJoinRelWithTrashed($relationName, $alias = '')
    {
        return $this->leftJoinRel($relationName, $alias, true);
    }

    /**
     * Analyse le nom de la relation pour en extraire l'alias de la table sur laquelle
     * effectuer la jointure.
     *
     * @param  string &$relationName
     * @param  string &$parentAlias
     * @return void
     */
    private function parseRelationName(&$relationName, &$parentAlias)
    {
        if (strpos($relationName, '.') !== false) {
            list($parentAlias, $relationName) = explode('.', $relationName);
        } else {
            $parentAlias = $this->model->getTable();

            if ($parentAlias && !isset($this->relatedModels[$parentAlias])) {
                $this->relatedModels[$parentAlias] = $this->model;
            }
        }
    }

    /**
     * Construit la condition de jointure en fonction de la relation.
     *
     * @param  \Illuminate\Database\Eloquent\Relations\Relation $relation
     * @param  boolean $withTrashed
     * @return \Closure
     */
    private function buildCond(Relation $relation, $withTrashed)
    {
        // HasOneOrMany (et MorphOneOrMany)
        if ($relation instanceof HasOneOrMany) {
            $localKey = $relation->getParent()->getQualifiedKeyName();
            $foreignKey = $relation->getRelated()->getTable().'.'.$relation->getPlainForeignKey();
        }
        // BelongsTo
        elseif ($relation instanceof BelongsTo) {
            $localKey = $relation->getRelated()->getQualifiedKeyName();
            $foreignKey = $relation->getParent()->getTable().'.'.$relation->getForeignKey();
        }
        // Relation non supportée...
        else {
            throw new Exception("Relation not supported for making join.");
        }

        return (function($join) use ($localKey, $foreignKey, $relation, $withTrashed) {
            $join->on($localKey, '=', $foreignKey);

            if ($relation instanceof MorphOneOrMany) {
                $morphType = $relation->getRelated()->getTable().'.'.$relation->getPlainMorphType();
                $join->where($morphType, '=', $relation->getMorphClass());
            }

            if (!$withTrashed && in_array(static::SOFT_DELETES_TRAIT, class_uses($relation->getRelated()))) {
                $join->whereNull($relation->getRelated()->getQualifiedDeletedAtColumn());
            }
        });
    }

    /**
	 * Ajoute les mises à jour des champs "updated_at" des tables pour lesquelles
     * il y a modification de champs.
	 *
	 * @param  array $values
	 * @return array
	 */
	protected function addUpdatedAtColumn(array $values)
	{
        $added = false;

        foreach ($values as $column => $value) {
            if (strpos($column, '.')) {
                list($alias, $column) = explode('.', $column);

                if (isset($this->relatedModels[$alias]) && $this->relatedModels[$alias]->usesTimestamps()) {
                    $updatedAtColumn = "$alias.".$this->relatedModels[$alias]->getUpdatedAtColumn();

                    if (!array_key_exists($updatedAtColumn, $values)) {
                        $values[$updatedAtColumn] = $this->model->freshTimestampString();
                        $added = true;
                    }
                }
            }
        }

        return $added ? $values : parent::addUpdatedAtColumn($values);
	}
}
