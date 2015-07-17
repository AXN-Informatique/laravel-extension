<?php

namespace Axn\Illuminate\Database\Query\Grammars;

use Illuminate\Database\Query\Grammars\MysqlGrammar as BaseMysqlGrammar;
use Illuminate\Database\Query\Builder;

class MysqlGrammar extends BaseMysqlGrammar
{
    /**
     * Compile une requête "delete" en SQL en tenant compte de l'alias sur le "from".
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return string
     */
    public function compileDelete(Builder $query)
    {
        list(, $alias) = explode(' as ', $query->from);

        $sql = parent::compileDelete($query);

        if (!empty($alias)) {
            $sql = preg_replace('/^delete.* from/U', 'delete '.$this->wrap($alias).' from', $sql);
        }

        return $sql;
    }
}
