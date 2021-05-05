<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Tests\App\Http\Livewire\UsersTable;
use Daguilarm\BelichTables\Tests\TestCase;
use Livewire\Livewire;

// test --filter=SearchTableComponentTest
class SearchTableComponentTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->table = new UsersTable();
    }

    // test --filter=test_table_component_search_attributes
    public function test_table_component_search_attributes(): void
    {
        Livewire::test(UsersTable::class)
            // Search attributes
            ->set('showSearch', false)
            ->assertSet('showSearch', false)
            ->set('searchUpdateMethod', 'lazy')
            ->assertSet('searchUpdateMethod', 'lazy')
            ->assertNotSet('searchUpdateMethod', 'debounce')
            ->set('searchDebounce', 550)
            ->assertSet('searchDebounce', 550)
            ->assertNotSet('searchDebounce', 350)
            ->set('clearSearchButton', false)
            ->assertSet('clearSearchButton', false);
    }

    // test --filter=test_table_component_search_input
    public function test_table_component_search_input(): void
    {
        // Total results
        Livewire::test(UsersTable::class)
            // Get the total results
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 9)
            // Search results for...
            ->call('typeSearchForTesting', 'Fernando')
            // Update results...
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 1)
            // Clear search
            ->call('clearSearch')
            // Update results...
            ->call('totalResultsForTesting')
            ->assertCount('totalResultsForTesting', 9);
    }
}
