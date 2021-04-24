<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Components\TableComponent;
use Daguilarm\BelichTables\Tests\_Http\Livewire\UsersTable;
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

    // test --filter=test_tablecomponent_attributes
    public function test_tablecomponent_attributes(): void
    {
        Livewire::test(UsersTable::class)
            // Table attributes
            ->set('refresh', true)
            ->assertSet('refresh', true)
            ->set('refreshInSeconds', 5)
            ->assertSet('refreshInSeconds', 5)
            ->assertNotSet('refreshInSeconds', 2)
            ->set('showCheckboxes', false)
            ->assertSet('showCheckboxes', false)
            ->set('showOffline', false)
            ->assertSet('showOffline', false)
            ->set('showLoading', false)
            ->assertSet('showLoading', false)
            ->set('showTableHead', false)
            ->assertSet('showTableHead', false)
            ->set('showTableFooter', false)
            ->assertSet('showTableFooter', false)
            // Pagination attributes
            ->set('showPagination', false)
            ->assertSet('showPagination', false)
            ->set('paginationTheme', 'tailwind')
            ->assertSet('paginationTheme', 'tailwind')
            ->assertNotSet('paginationTheme', 'bootstrap')
            // Per page attributes
            ->set('showPerPage', false)
            ->assertSet('showPerPage', false)
            ->set('perPageOptions', [10, 25, 50, 100, 200])
            ->assertSet('perPageOptions', [10, 25, 50, 100, 200])
            ->assertCount('perPageOptions', 5)
            ->set('perPage', 10)
            ->assertSet('perPage', 10)
            ->assertNotSet('perPage', 25)
            // Other attributes
            ->set('newResource', '/my/url/path')
            ->assertSet('newResource', '/my/url/path')
            ->assertNotSet('newResource', '');
    }

    // test --filter=test_tablecomponent_view_exists
    public function test_tablecomponent_view_exists(): void
    {
        Livewire::test(UsersTable::class)
            ->assertViewIs('belich-tables::tailwind.table-component');
    }
}
