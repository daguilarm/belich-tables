<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Components\TableComponent;
use Daguilarm\BelichTables\Tests\TestCase;
use Daguilarm\BelichTables\Tests\_Http\Livewire\UsersTable;

// test --filter=SearchTableComponentTest
class SearchTableComponentTest extends TestCase
{
    protected TableComponent $table;

    public function setUp(): void
    {
        parent::setUp();

        $this->table = new UsersTable();
    }
}
