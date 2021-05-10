<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Components\TableComponent;
use Daguilarm\BelichTables\Tests\App\Http\Livewire\UsersTable;
use Daguilarm\BelichTables\Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Livewire;

// test --filter=TableComponentTest
class TableComponentTest extends TestCase
{
    protected TableComponent $table;

    public function setUp(): void
    {
        parent::setUp();

        $this->table = new UsersTable();
    }

    // test --filter=test_table_component_is_working
    public function test_table_component_is_working(): void
    {
        $this->assertInstanceOf(
            $instance = TableComponent::class,
            $class = $this->table
        );
    }

    // test --filter=test_table_component_columns
    public function test_table_component_columns(): void
    {
        $this->assertCount(
            $columns = 6, // 5 columns + 1 action column
            $tableColumns = $this->table->columns(),
        );
    }

    // test --filter=test_table_component_results
    public function test_table_component_results(): void
    {
        $results = $this->table->models();

        $this->assertInstanceOf(Builder::class, $results);
        $this->assertEquals(30, $results->count());
    }

    // test --filter=test_table_component_pagination
    public function test_table_component_pagination(): void
    {
        // Test changing per page
        $this->table->perPage = 3;
        $this->assertEquals(3, $this->table->perPage);

        // Test pagination
        $pagination = $this->table->models()->paginate($this->table->perPage);

        $this->assertEquals($currentPage = 1, $pagination->currentPage());
        $this->assertEquals($totalPages = 3, $pagination->count());
        $this->assertEquals($lastPage = 10, $pagination->lastPage());
    }

    // test --filter=test_table_component_view_exists
    public function test_table_component_view_exists(): void
    {
        Livewire::test(UsersTable::class)
            ->assertViewIs('belich-tables::tailwind.table-component');
    }
}
