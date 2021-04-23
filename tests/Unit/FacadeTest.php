<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Facades\BelichTables;
use Daguilarm\BelichTables\Tests\TestCase;

// test --filter=FacadeTest
class FacadeTest extends TestCase
{
    protected TableComponent $table;

    // test --filter=test_facade_include_path
    public function test_facade_include_path(): void
    {
        $this->assertEquals(
            $facade = BelichTables::include('includes.folder.for.test'),
            $path = 'belich-tables::tailwind.includes.folder.for.test',
        );
    }

    // test --filter=test_facade_no_results
    public function test_facade_no_results(): void
    {
        $this->assertEquals(
            $facade = BelichTables::noResults(),
            $path = config('belich-tables.noResults'),
        );
    }
}
