<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Components\TableComponent;
use Daguilarm\BelichTables\Tests\_Http\Livewire\UsersTable;
use Daguilarm\BelichTables\Tests\TestCase;

// test --filter=FilterTableComponentTest
class FilterTableComponentTest extends TestCase
{
    protected TableComponent $table;

    public function setUp(): void
    {
        parent::setUp();

        $this->table = new UsersTable();
    }
}
