<?php

namespace Axn\Illuminate\Database;

use Illuminate\Database\MySqlConnection as BaseMySqlConnection;

class MySqlConnection extends BaseMySqlConnection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \Axn\Illuminate\Database\Query\Grammars\MySqlGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return new Query\Grammars\MySqlGrammar;
    }
}
