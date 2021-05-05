<?php

namespace Daguilarm\BelichTables\Tests\App\Http\Livewire;

use Daguilarm\BelichTables\Components\TableComponent;
use Daguilarm\BelichTables\Tests\App\Filters\FilterByBoolean;
use Daguilarm\BelichTables\Tests\App\Filters\FilterByDate;
use Daguilarm\BelichTables\Tests\App\Filters\FilterByUser;
use Daguilarm\BelichTables\Tests\App\Filters\FilterByYear;
use Daguilarm\BelichTables\Tests\App\Models\User;
use Daguilarm\BelichTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class UsersTable extends TableComponent
{
    public string $newResource = '../../dashboard/users/create';
    public array $exports = ['xls', 'csv', 'pdf'];

    /**
     * Column constructor.
     */
    public function __construct(?string $id = null)
    {
        parent::__construct($id);
    }

    public function query(): Builder
    {
        return User::select('users.*')->with('profile');
    }

    public function columns(): array
    {
        return [
            Column::make('ID')
                ->sortable(),
            Column::make('Active')
                ->showAsBoolean(),
            Column::make('Name')
                ->searchable()
                ->sortable()
                ->format(static function ($value) {
                    return Str::of($value)
                        ->plural()
                        ->title();
                }),
            Column::make('Telephone', 'profile.profile_telephone')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            FilterByBoolean::make()
                ->tableColumn('active'),
            FilterByBoolean::make('boolean_custom')
                ->tableColumn('active')
                ->trueValue('true value')
                ->falseValue('false value'),
            FilterByYear::make()
                ->tableColumn('date'),
            FilterByUser::make(),
            FilterByDate::make()
                ->tableColumn('date'),
        ];
    }
}
