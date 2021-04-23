<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Components\TableComponent;
use Daguilarm\BelichTables\Tests\_Http\Livewire\UsersTable;
use Daguilarm\BelichTables\Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;

// test --filter=TableComponentTest
class TableComponentTest extends TestCase
{
    protected TableComponent $table;

    public function setUp(): void
    {
        parent::setUp();

        $this->table = new UsersTable();
    }

    // test --filter=test_tablecomponent_is_working
    public function test_tablecomponent_is_working(): void
    {
        $this->assertInstanceOf(
            $instance = TableComponent::class,
            $class = $this->table
        );
    }

    // test --filter=test_tablecomponent_columns
    public function test_tablecomponent_columns(): void
    {
        $this->assertCount(
            $columns = 4,
            $tableColumns = $this->table->columns(),
        );
    }

    // test --filter=test_tablecomponent_results
    public function test_tablecomponent_results(): void
    {
        $results = $this->table->models();

        $this->assertInstanceOf(Builder::class, $results);
        $this->assertEquals(9, $results->count());
    }

    // test --filter=test_tablecomponent_pagination
    public function test_tablecomponent_pagination(): void
    {
        // Test changing per page
        $this->table->perPage = 3;
        $this->assertEquals(3, $this->table->perPage);

        // Test pagination
        $pagination = $this->table->models()->paginate($this->table->perPage);

        $this->assertEquals($currentPage = 1, $pagination->currentPage());
        $this->assertEquals($totalPages = 3, $pagination->count());
        $this->assertEquals($lastPage = 3, $pagination->lastPage());
    }
}
