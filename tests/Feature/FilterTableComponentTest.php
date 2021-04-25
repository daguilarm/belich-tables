<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Tests\_Http\Livewire\UsersTable;
use Daguilarm\BelichTables\Tests\TestCase;
use Livewire\Livewire;

// test --filter=FilterTableComponentTest
class FilterTableComponentTest extends TestCase
{
    protected TableComponent $table;

    public function setUp(): void
    {
        parent::setUp();
    }

    // test --filter=test_table_component_filter_by_boolean
    public function test_table_component_filter_by_boolean(): void
    {
        Livewire::test(UsersTable::class)
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 9)
            ->set('filterValues.boolean', true)
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 6);
    }

    // test --filter=test_table_component_filter_by_user
    public function test_table_component_filter_by_user(): void
    {
        Livewire::test(UsersTable::class)
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 9)
            ->set('filterValues.user', '1')
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 1);
    }

    // test --filter=test_table_component_filter_by_year
    public function test_table_component_filter_by_year(): void
    {
        Livewire::test(UsersTable::class)
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 9)
            ->set('filterValues.year', '2021')
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 3);
    }

    // test --filter=test_table_component_filter_by_date
    public function test_table_component_filter_by_date(): void
    {
        Livewire::test(UsersTable::class)
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 9)
            // Date start
            ->set('filterValues.date.start', '2021-04-22')
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 3)
            // Date start - end
            ->set('filterValues.date.start', '2018-04-22')
            ->set('filterValues.date.end', '2021-04-22')
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 9);
    }
}
