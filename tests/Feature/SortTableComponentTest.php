<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Tests\App\Http\Livewire\UsersTable;
use Daguilarm\BelichTables\Tests\TestCase;
use Livewire\Livewire;

// test --filter=SortTableComponentTest
class SortTableComponentTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    // test --filter=test_table_component_sort_attributes
    public function test_table_component_sort_attributes(): void
    {
        Livewire::test(UsersTable::class)
            // Sort attributes
            ->set('sortField', 'name')
            ->assertSet('sortField', 'name')
            ->assertNotSet('sortField', 'id')
            ->set('sortDirection', 'desc')
            ->assertSet('sortDirection', 'desc')
            ->assertNotSet('sortDirection', 'asc');
    }

    // test --filter=test_table_component_sort_direction
    public function test_table_component_sort_direction(): void
    {
        Livewire::test(UsersTable::class)
            // Default values
            ->assertSet('sortField', 'id')
            ->assertSet('sortDirection', 'asc')
            // We simulate clicking on the name column
            ->call('orderBy', 'name')
            // Verify the new value
            ->assertSet('sortField', 'name')
            // We simulate clicking on the name column in order to change direction
            ->call('orderBy', 'name')
            // Verify the new value
            ->assertSet('sortDirection', 'desc');
    }

    // // test --filter=test_table_component_sort_direction_for_a_relationship_field
    // public function test_table_component_sort_direction_for_a_relationship_field(): void
    // {
    //     Livewire::test(UsersTable::class)
    //         // We simulate clicking on the name column
    //         ->call('orderBy', 'profile.profile_telephone')
    //         // Verify the new value
    //         ->assertSet('sortField', 'profile.profile_telephone')
    //         // We simulate clicking on the name column in order to change direction
    //         ->call('orderBy', 'profile.profile_telephone')
    //         // Verify the new value
    //         ->assertSet('sortDirection', 'desc');
    // }
}
