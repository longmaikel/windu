<?php
declare(strict_types=1);

namespace Longmaikel\Test\Windu\Unit;

use Longmaikel\Windu\MySqlQueryBuilder;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class QueryBuilderTest extends MockeryTestCase
{

    private MySqlQueryBuilder $queryBuilder;

    /*
    assertStringMatchesFormat(string $format, string $string)
    assertStringNotMatchesFormat(string $format, string $string)
    assertStringMatchesFormatFile(string $formatFile, string $string)
    assertStringNotMatchesFormatFile(string $formatFile, string $string)
    assertStringStartsWith(string $prefix, string $string)
    assertStringStartsNotWith($prefix, $string)
    assertStringContainsString(string $needle, string $haystack)
    assertStringContainsStringIgnoringCase(string $needle, string $haystack)
    assertStringNotContainsString(string $needle, string $haystack)
    assertStringNotContainsStringIgnoringCase(string $needle, string $haystack)
    assertStringEndsWith(string $suffix, string $string)
    assertStringEndsNotWith(string $suffix, string $string)
    */

    protected function setUp(): void
    {
        parent::setUp();
        $this->queryBuilder = new MySqlQueryBuilder();
    }

    public function test_empty_string_when_query_builder_is_created(): void
    {
        //given
        $queryBuilder = $this->queryBuilder;

        //when
        $query = $queryBuilder->toSql();

        //then
        $this->assertSame('', $query);
    }

    public function test_query_contain_select_all_statement_when_select_has_no_params(): void
    {
        // given
        $queryBuilder = $this->queryBuilder;

        //when
        $query = $queryBuilder->select()
            ->toSql();

        //then
        $this->assertStringContainsString('SELECT * ', $query);
    }
    
}