<?php

namespace Longmaikel\Windu;

class QueryBuilder implements QueryBuilderContract
{

    protected array $fields;

    public function __construct()
    {
        $this->fields = [];
    }

    public function select(string $field): QueryBuilder
    {
        return $this;
    }
}