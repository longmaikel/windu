<?php
declare(strict_types=1);

namespace Longmaikel\Test\Windu\Unit;

use Longmaikel\Windu\MySqlQueryBuilder;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class QueryBuilderTest extends MockeryTestCase
{
    public function test_empty_string_when_query_builder_is_created(): void
    {
        $queryBuilder = new MySqlQueryBuilder();
        $query = $queryBuilder->toSql();
        $this->assertSame('', $query);
    }

    public function test_query_contain_select_all_statement_without_passing_any_params(): void
    {
        $queryBuilder = new MySqlQueryBuilder();
        $query = $queryBuilder->select()
            ->toSql();

        $this->assertStringContainsString('SELECT * ', $query);
    }
    
}