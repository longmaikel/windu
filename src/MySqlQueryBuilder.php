<?php
declare(strict_types=1);

namespace Longmaikel\Windu;

use JetBrains\PhpStorm\Pure;

class MySqlQueryBuilder
{

    private array $selectArray;

    public function __construct()
    {
        $this->selectArray = [];
    }

    public function toSql(): string
    {
        $query = '';
        $query .= $this->prepareSelectStatement($query);
        return $query;
    }

    public function select(string $column = '*'): MySqlQueryBuilder
    {
        $this->selectArray[] = $column;
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
        $query = $this->removeLastCommaFormString($query);
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

    protected function removeLastCommaFormString(string $needle): string
    {
        return rtrim($needle, ',');
    }

    protected function addWhiteSpaceToEndOfString(string $needle): string
    {
        return sprintf("%s ", $needle);
    }

}