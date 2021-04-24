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

    // test --filter=test_column_name_component
    public function test_column_name_component(): void
    {
        $columnName = (new Column('Name', 'name'))
            ->searchable()
            ->sortable()
            ->asHtml();

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
    }

    // test --filter=test_column_email_component
    public function test_column_email_component(): void
    {
        $columnEmail = (new Column('Email', 'email'))
            ->sortable()
            ->showAsBoolean()
            ->notAsHtml();

        // Verify values for email
        $this->assertTrue($columnEmail->isSortable());
        $this->assertFalse($columnEmail->isSearchable());
        $this->assertFalse($columnEmail->isHtml());
        $this->assertTrue($columnEmail->isBoolean());
        $this->assertEquals($columnEmail->getText(), 'Email');
        $this->assertEquals($columnEmail->getAttribute(), 'email');
    }

    // test --filter=test_column_type_component
    public function test_column_type_component(): void
    {
        $column = new Column('Email', 'email');

        // Verify column types
        $this->assertTrue($column->toBoolean()->type === 'bool');
        $this->assertTrue($column->toFloat()->type === 'float');
        $this->assertTrue($column->toInteger()->type === 'int');
        $this->assertTrue($column->toObject()->type === 'object');
        $this->assertTrue($column->toString()->type === 'string');
    }

    // test --filter=test_column_resolve_types_component
    public function test_column_resolve_types_component(): void
    {
        $column = new Column('Email', 'email');

        // types
        $columnBoolean = $column->toBoolean()->resolveType('1');
        $columnFloat = $column->toFloat()->resolveType('1');
        $columnInteger = $column->toInteger()->resolveType('1');
        $columnObject = $column->toObject()->resolveType('1');
        $columnString = $column->toString()->resolveType(22);

        // Verify is column resolve the types
        $this->assertTrue(is_bool($columnBoolean));
        $this->assertTrue(is_float($columnFloat));
        $this->assertTrue(is_integer($columnInteger));
        $this->assertTrue(is_object($columnObject));
        $this->assertTrue(is_string($columnString));
    }
}
