<?php

namespace Staudenmeir\EloquentEagerLimit;

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Grammars\Grammar;
use RuntimeException;
use Staudenmeir\EloquentEagerLimit\Grammars\MySqlGrammar;
use Staudenmeir\EloquentEagerLimit\Grammars\PostgresGrammar;
use Staudenmeir\EloquentEagerLimit\Grammars\SQLiteGrammar;
use Staudenmeir\EloquentEagerLimit\Grammars\SqlServerGrammar;
use Staudenmeir\EloquentEagerLimit\Traits\HasEagerLimitRelationships;

trait HasEagerLimit
{
    use HasEagerLimitRelationships;

    /**
     * Get a new query builder instance for the connection.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newBaseQueryBuilder()
    {
        $connection = $this->getConnection();

        $grammar = $this->getQueryGrammar($connection);

        return new Builder($connection, $grammar, $connection->getPostProcessor());
    }

    /**
     * Get the query grammar.
     *
     * @return Grammar
     */
    protected function getQueryGrammar(Connection $connection)
    {
        $driver = $connection->getDriverName();

        return match ($driver) {
            'mysql', 'mariadb' => new MySqlGrammar($connection),
            'pgsql' => new PostgresGrammar($connection),
            'sqlite' => new SQLiteGrammar($connection),
            'sqlsrv' => new SqlServerGrammar($connection),
            default => throw new RuntimeException('This database is not supported.'), // @codeCoverageIgnore
        };
    }
}
