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

    public function test_query_contain_select_key_word(): void
    {
        // given
        $queryBuilder = $this->queryBuilder;

        //when
        $query = $queryBuilder->select()
            ->toSql();

        //then
        $this->assertStringContainsString('SELECT', $query);
    }

    public function test_query_contain_select_all_statement_when_select_has_no_params(): void
    {
        // given
        $queryBuilder = $this->queryBuilder;

        //when
        $query = $queryBuilder->select()
            ->toSql();

        //then
        $this->assertStringContainsString('*', $query);
    }

    public function test_query_contain_selected_string_column(): void
    {
        // given
        $queryBuilder = $this->queryBuilder;

        //when
        $query = $queryBuilder->select('c.id')
            ->toSql();

        //then
        $this->assertStringContainsString('c.id', $query);
    }

    public function test_query_contain_selected_multiple_string_columns(): void
    {
        // given
        $queryBuilder = $this->queryBuilder;

        //when
        $query = $queryBuilder->select('c.id', 'c.name', 'c.created_at')
            ->toSql();

        //then
        $this->assertStringContainsString('c.id,', $query);
        $this->assertStringContainsString('c.name,', $query);
        $this->assertStringContainsString('c.created_at', $query);
    }

    public function test_query_contain_selected_columns_passing_in_array(): void
    {
        // given
        $queryBuilder = $this->queryBuilder;
        $columns = ['c.id', 'c.name', 'c.created_at'];

        //when
        $query = $queryBuilder->select($columns)
            ->toSql();

        //then
        $this->assertStringContainsString('c.id,', $query);
        $this->assertStringContainsString('c.name,', $query);
        $this->assertStringContainsString('c.created_at', $query);
    }

//    public function selectAllCases(): array
//    {
//        return [
//            [(new MySqlQueryBuilder())->select()->select('c.id')->toSql()],
//            [(new MySqlQueryBuilder())->select('c.id')->select()->toSql()],
//            [(new MySqlQueryBuilder())->select()->select('c.id')->select()->toSql()],
//            [(new MySqlQueryBuilder())->select('*','c.name')->toSql()],
//            [(new MySqlQueryBuilder())->select('c.name','*')->toSql()],
//            [(new MySqlQueryBuilder())->select('c.name','*', 'c.id')->toSql()],
//        ];
//    }


    
}