<?php
declare(strict_types=1);

namespace Longmaikel\Windu;

class MySqlQueryBuilder
{

    private array $selectArray;

    public function __construct()
    {
        $this->selectArray = [];
        $this->hasSelectAllStatement = false;
    }

    public function toSql(): string
    {
        $query = '';
        $query .= $this->prepareSelectStatement($query);
        return $query;
    }

    public function select(string|array $column = '*', string ...$columns): MySqlQueryBuilder
    {
        if (!is_array($column)) {
            $column = [$column];
        }

        $this->selectArray = array_merge($this->selectArray, $column, $columns);
        return $this;
    }

    protected function prepareSelectStatement(string $query): string
    {
        $aggregator = $this->selectArray;

        if ($this->aggregatorIsEmpty($aggregator)) {
            return $query;
        }

        $query = $this->addSelectKeyWordToQuery($query);
        $query = $this->addSelectColumnsToQuery($aggregator, $query);
        $query = $this->removeLastCommaFromString($query);
        return $this->addWhiteSpaceToEndOfString($query);

    }

    protected function aggregatorIsEmpty(array $aggregator): bool
    {
        return empty($aggregator);
    }

    protected function addSelectKeyWordToQuery(string $query): string
    {
        return $this->addKeyWordToQuery('select', $query);
    }

    protected function addKeyWordToQuery(string $word, string $query): string
    {
        return sprintf("%s %s", $query, strtoupper($word));
    }

    protected function addSelectColumnsToQuery(array $aggregator, string $query): string
    {
        foreach ($aggregator as $column) {
            $query = sprintf("%s %s,", $query, $column);
        }

        return $query;
    }

    protected function removeLastCommaFromString(string $needle): string
    {
        return rtrim($needle, ',');
    }

    protected function addWhiteSpaceToEndOfString(string $needle): string
    {
        return sprintf("%s ", $needle);
    }

}