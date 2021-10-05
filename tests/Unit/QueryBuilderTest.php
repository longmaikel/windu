<?php
declare(strict_types=1);

namespace Longmaikel\Test\Windu\Unit;

use Longmaikel\Windu\MySqlQueryBuilder;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class QueryBuilderTest extends MockeryTestCase
{
    public function test_empty_string_when_query_builder_is_created()
    {
        $queryBuilder = new MySqlQueryBuilder();
        $query = $queryBuilder->toSql();
        $this->assertSame('', $query);
    }
}