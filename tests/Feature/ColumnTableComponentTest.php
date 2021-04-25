<?php

namespace Daguilarm\BelichTables\Tests\Feature;

use Daguilarm\BelichTables\Facades\BelichTables;
use Daguilarm\BelichTables\Tests\_Models\User;
use Daguilarm\BelichTables\Tests\TestCase;
use Daguilarm\BelichTables\Views\Action;
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
        $columnInteger = $column->toInteger()->resolveType('1.12');
        $columnObject = $column->toObject()->resolveType('1');
        $columnString = $column->toString()->resolveType(22);

        // Verify is column resolve the types
        $this->assertTrue(is_bool($columnBoolean));
        $this->assertTrue(is_float($columnFloat));
        $this->assertTrue(is_integer($columnInteger));
        $this->assertTrue(is_object($columnObject));
        $this->assertTrue(is_string($columnString));

        // Verify the types
        $this->assertEquals($columnBoolean, true);
        $this->assertEquals($columnFloat, 1.0);
        $this->assertEquals($columnInteger, 1);
        $this->assertEquals($columnString, '22');
    }

    // test --filter=test_column_hidden_component
    public function test_column_hidden_component(): void
    {
        $column = new Column('Email', 'email');

        $this->assertTrue($column->hideIf(false)->isVisible());
        $this->assertTrue($column->hide()->isHidden());
    }

    // test --filter=test_column_view_component
    public function test_column_view_component(): void
    {
        // Get column
        $column = (new Column('Email', 'email'))
            ->render(static function (User $user) {
                return view('avatar', compact('user'));
            });

        // See if is callable
        $this->assertTrue($column->isRenderable());

        // Get view
        $view = $column->renderCallback(new User())->render();

        // Verify render view has the correct dusk attributes
        $this->assertEquals(
            ['test-image', 'test-name', 'test-email'],
            $this->getDuskAttributes($view),
        );
    }

    // test --filter=test_column_action_component
    public function test_column_action_component(): void
    {
        // Get user
        $user = User::find(5);

        // Get action view
        $actionView = BelichTables::include('sections.actions.default');

        // Render the action
        $action = app(Action::class)
            ->make($actionView)
            ->renderCallback($user)
            ->render();

        // Verify action view has the correct dusk attributes
        $this->assertEquals(
            ['show-button-5', 'edit-button-5', 'delete-button-5'],
            $this->getDuskAttributes($action),
        );
    }
}
