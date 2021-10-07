<?php
declare(strict_types=1);

namespace Longmaikel\Windu;

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
        if ($this->selectArray) {
            $query = sprintf("%s SELECT", $query);
            foreach ($this->selectArray as $column) {
                $query = sprintf("%s %s,", $query, $column);
            }
            $query = rtrim($query, ',');
            $query = sprintf("%s ", $query);
        }
        return $query;
    }

    public function select(string $column = '*'): MySqlQueryBuilder
    {
        $this->selectArray[] = $column;
        return $this;
    }
}