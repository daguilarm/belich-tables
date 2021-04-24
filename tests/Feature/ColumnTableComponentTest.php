<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Tests\TestCase;
use Daguilarm\BelichTables\Views\Column;

// test --filter=ColumnTableComponentTest
class ColumnTableComponentTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    // test --filter=test_column_component
    public function test_column_component(): void
    {
        // Set the columns
        $columnName = (new Column('Name', 'name'))
            ->searchable()
            ->sortable()
            ->asHtml();

        $columnEmail = (new Column('Email', 'email'))
            ->sortable()
            ->showAsBoolean();

        // Check if the instance is correct
        $this->assertInstanceOf(
            $instance = Column::class,
            $class = $columnName,
        );

        // Verify values for name
        $this->assertTrue($columnName->isSortable());
        $this->assertTrue($columnName->isSearchable());
        $this->assertTrue($columnName->isHtml());
        $this->assertFalse($columnName->isBoolean());
        $this->assertEquals($columnName->getText(), 'Name');
        $this->assertEquals($columnName->getAttribute(), 'name');

        // Verify values for email
        $this->assertTrue($columnEmail->isSortable());
        $this->assertFalse($columnEmail->isSearchable());
        $this->assertFalse($columnEmail->isHtml());
        $this->assertTrue($columnEmail->isBoolean());
        $this->assertEquals($columnEmail->getText(), 'Email');
        $this->assertEquals($columnEmail->getAttribute(), 'email');
    }
}
