<?php

namespace Longmaikel\Windu;

use Closure;

interface QueryBuilderI
{
    public const ORDER_BY_TYPE_ASC = 'asc';
    public const ORDER_BY_TYPE_DESC = 'desc';

    public function select(array|string $column, string ...$columns): QueryBuilder;
    public function selectAs(string|QueryBuilder|Expression $column, string $alias): QueryBuilder;
    public function selectExpression(Expression $column, ?string $alias = null): QueryBuilder;
    public function selectRaw(string $column, ?string $alias = null): QueryBuilder;

    public function from(string|QueryBuilder $table, ?string $alias = null): QueryBuilder;

    public function withSelfJoin(?string $alias = null): QueryBuilder;

    public function join(string|QueryBuilder|Closure $table, ?string $alias = null, string|Closure $on = null): QueryBuilder;
    public function crossJoin(string|QueryBuilder|Closure $table, ?string $alias = null): QueryBuilder;
    public function innerJoin(string|QueryBuilder|Closure $table, ?string $alias = null, string|Closure $on = null): QueryBuilder;
    public function leftJoin(string|QueryBuilder|Closure $table, ?string $alias = null, string|Closure $on = null): QueryBuilder;
    public function leftOuterJoin(string|QueryBuilder|Closure $table, ?string $alias = null, string|Closure $on = null): QueryBuilder;
    public function rightJoin(string|QueryBuilder|Closure $table, ?string $alias = null, string|Closure $on = null): QueryBuilder;
    public function rightOuterJoin(string|QueryBuilder|Closure $table, ?string $alias = null, string|Closure $on = null): QueryBuilder;
    public function fullJoin(string|QueryBuilder|Closure $table, ?string $alias = null, string|Closure $on = null): QueryBuilder;

    public function fullOuterJoin(string|QueryBuilder|Closure $table, ?string $alias = null, string|Closure $on = null): QueryBuilder;
    public function orderBy(string $column, string $type = QueryBuilder::ORDER_BY_TYPE_ASC) : QueryBuilder;
    public function groupBy(array|string $column, string ...$columns): QueryBuilder;

    public function withRollup(): QueryBuilder;
    public function union(string|QueryBuilder $query): QueryBuilder;
    public function unionDistinct(string|QueryBuilder $query): QueryBuilder;
    public function unionAll(string|QueryBuilder $query): QueryBuilder;

    public function where(string $column, string|Closure $operator, string|int|float $value = null): QueryBuilder;
    public function andWhere(string $column, string|Closure $operator, string|int|float $value = null): QueryBuilder;
    public function orWhere(string $column, string|Closure $operator, string|int|float $value = null): QueryBuilder;
    public function whereIn(string $column, array|Closure|QueryBuilder $values): QueryBuilder;
    public function whereNull(string $column): QueryBuilder;
    public function whereNotNull(string $column): QueryBuilder;
    public function whereBetween(string $column, string $between, string $and): QueryBuilder;
    public function whereLike(string $column, string $pattern): QueryBuilder;
    public function whereNotLike(string $column, string $pattern): QueryBuilder;
    public function whereExists(string|QueryBuilder $query): QueryBuilder;
    public function whereNotExists(string|QueryBuilder $query): QueryBuilder;

    public function having(string $column, string|Closure $operator, string|int|float $value = null): QueryBuilder;
    public function andHaving(string $column, string|Closure $operator, string|int|float $value = null): QueryBuilder;
    public function orHaving(string $column, string|Closure $operator, string|int|float $value = null): QueryBuilder;
    public function havingIn(string $column, array|Closure|QueryBuilder $values): QueryBuilder;
    public function havingNull(string $column): QueryBuilder;
    public function havingNotNull(string $column): QueryBuilder;
    public function havingBetween(string $column, string $between, string $and): QueryBuilder;
    public function havingLike(string $column, string $pattern): QueryBuilder;
    public function havingNotLike(string $column, string $pattern): QueryBuilder;

    public function toSql(): string;
    public function get(): iterable;
    public function getFirst(): iterable;
    public function count(): int;




}