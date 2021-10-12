<?php
declare(strict_types=1);


namespace Longmaikel\Windu;


interface QueryBuilder
{
    public function select(array|string $column, string ...$columns): QueryBuilder;
    public function from(string $table, ?string $alias = null): QueryBuilder;

}