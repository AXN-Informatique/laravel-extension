<?php

namespace Axn\Illuminate\Database\Query\Grammars;

use Illuminate\Database\Query\Grammars\MySqlGrammar as BaseMySqlGrammar;
use Illuminate\Database\Query\Builder;

class MySqlGrammar extends BaseMySqlGrammar
{
    /**
     * Compile une requête "delete" en SQL en tenant compte de l'alias sur le "from".
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return string
     */
    public function compileDelete(Builder $query)
    {
        $sql = parent::compileDelete($query);

        if (strpos($query->from, ' as ')) {
            list(, $alias) = explode(' as ', $query->from);

            $sql = preg_replace('/^delete.* from/U', 'delete '.$this->wrap($alias).' from', $sql);
        }

        return $sql;
    }
}
