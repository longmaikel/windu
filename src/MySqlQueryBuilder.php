<?php
declare(strict_types=1);

namespace Longmaikel\Windu;

use Exception;

class MySqlQueryBuilder
{

    private array $selectArray;
    private array $table;

    public function __construct()
    {
        $this->selectArray = [];
        $this->table = [];
    }

    public function toSql(): string
    {
        $query = '';
        $query .= $this->prepareSelectStatement($query);

        if (!empty($this->table)) {
            $table = $this->table[0];
            $query = sprintf("%s FROM %s", $query, $table);
        }

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

    public function from(string $table): MySqlQueryBuilder
    {
        $this->table = [$table];
        return $this;
    }

    protected function prepareSelectStatement(string $query): string
    {
        $aggregator = $this->selectArray;

        if ($this->aggregatorIsEmpty($aggregator)) {
            return $query;
        }
        
        $aggregator = $this->prepareSelectAggregator($aggregator);
        
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

    protected function prepareSelectAggregator(array $aggregator): array
    {
        $foundSelectAllStmt = false;
        foreach ($aggregator as $key => $column) {
            if ('*' === $column) {
                if ($foundSelectAllStmt) {
                    unset($aggregator[$key]);
                } else {
                    $foundSelectAllStmt = true;
                }
            }
        }
        return $aggregator;
    }

}