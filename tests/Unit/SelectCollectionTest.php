<?php

namespace Longmaikel\Test\Windu\Unit;

use Longmaikel\Test\Windu\Framework\TestCase;
use Longmaikel\Windu\Collection\SelectStatementCollection;

class SelectCollectionTest extends TestCase
{

    private SelectStatementCollection $collection;

    protected function setUp(): void
    {
        $this->collection = new SelectStatementCollection();
        parent::setUp();
    }

    public function test_push_element_into_collection(): void
    {
        //given
        $collection = $this->collection;
        $column = new SelectEntity('clients.id', 'client_id');

        //when
        $collection->push($column);A``

        //then
        $this->assertContains();

    }
}