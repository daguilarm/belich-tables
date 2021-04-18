![Package Logo](https://banners.beyondco.de/Livewire%20Tables.png?theme=light&packageManager=composer+require&packageName=daguilarm%2Flivewire-tables&pattern=bamboo&style=style_1&description=Manage+your+tables+with+Laravel+Livewire&md=1&showWatermark=0&fontSize=100px&images=template)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/daguilarm/livewire-tables.svg?style=flat-square)](https://packagist.org/packages/daguilarm/livewire-tables)
[![StyleCI](https://styleci.io/repos/354914653/shield?style=plastic)](https://github.styleci.io/repos/354914653)
[![Total Downloads](https://img.shields.io/packagist/dt/daguilarm/livewire-tables.svg?style=flat-square)](https://packagist.org/packages/daguilarm/livewire-tables)
![GitHub last commit](https://img.shields.io/github/last-commit/daguilarm/livewire-tables)

> :warning: **This package is currently under development**: Be very careful here!

This package is base on the https://github.com/rappasoft/laravel-livewire-tables package.

## Requirements

This package need at least:

- PHP ^8.0
- Laravel ^8.0
- Laravel Livewire ^2.0
- AlpineJS ^2.0
- TailwindCSS ^2.0

## Installation

You can install the package via composer:

    composer require daguilarm/livewire-tables

Or include in your `composer.json`:

    "daguilarm/livewire-tables": "^1.0"

## Publishing Assets

Publishing assets are mandatory for this package:

    php artisan vendor:publish --provider="Daguilarm\LivewireTables\LivewireTablesServiceProvider"

## Usage

### Creating Tables

To create a table component you draw inspiration from the below stub:

```php
<?php

namespace App\Http\Livewire;

use App\User;
use Daguilarm\LivewireTables\Components\TableComponent;
use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class UsersTable extends TableComponent
{
    public function query() : Builder
    {
        return User::with('role')->withCount('permissions');
    }

    public function columns() : array
    {
        return [
            Column::make('ID')
                ->searchable()
                ->sortable(),
            Column::make('Name')
                ->searchable()
                ->sortable()
                ->format(function($value) {
                    return Str::of($value)
                        ->plural()
                        ->title();
                })
                ->hideFrom('lg'),
            Column::make('Telephone', 'profile.profile_telephone')
                ->searchable()
                ->sortable(),
            Column::make('Avatar', 'profile.profile_avatar')
                ->searchable()
                ->render(function(User $user) {
                    return view('profile.avatar', compact('user'));
                }),
            Action::make(),
        ];
    }
}
```

Your component must implement two methods:

```php
/**
 * This defines the start of the query, usually Model::query() but can also eager load relationships and counts if needed.
 */
public function query() : Builder;

/**
 * This defines the columns of the table, they don't necessarily have to map to columns on the database table.
 */
public function columns() : array;
```

### Rendering the Table

Place the following where you want the table component to appear.

```html
<livewire:flash-container />
<livewire:users-table />
```

The component `flash-container` will add the hability to show flash messages from the package. **You can remove it if you don't want this feature.** and just use:

```html
<livewire:users-table />
```

### Defining Columns

You can define the columns of your table with the column class. The following methods are available to chain to a column:

```php

/**
 * The first argument is the column header text
 * The attribute can be omitted if the text is equal to the lower case snake_cased version of the column
 * The attribute can also be used to reference a relationship (i.e. role.name)
 */
public static function make(string $text, ?string $attribute = null): Column

/**
 * Used to format the column data in different ways, see the HTML Components section.
 * You will be passed the current model and column (if you need it for some reason) which can be omitted as an argument if you don't need it.
 */
public function format(callable $callable = null) : self;

/**
 * This column is searchable, with no callback it will search the column by name or by the supplied relationship, using a callback overrides the default searching functionality.
 */
public function searchable(callable $callable = null) : self;

/**
 * This column is sortable, with no callback it will sort the column by name and sort order defined on the components $sortDirection variable
 */
public function sortable(callable $callable = null) : self;

/**
 * The columns output will be put through {!! !!} instead of {{ }}.
 */
public function raw() : self;

/**
 * Hide this column permanently
 */
public function hide() : self;

/**
 * Hide this column base on screen size. Acepted values: 'sm', 'md', 'lg', 'xl'. For example: Column::hideFrom('lg') will hide the column except for the screens 'xl' or higher values (such as '2xl').
 */
public function hideFrom(string $value): self

/**
 * Hide this column based on a condition. i.e.: user has or doesn't have a role or permission. Must return a boolean, not a closure.
 */
public function hideIf($condition) : self;

/**
 * This column is only included in exports and is not available to the UI
 */
public function exportOnly() : self;

/**
 * This column is excluded from the export but visible to the UI unless defined otherwise with hide() or hideIf()
 */
public function excludeFromExport() : self;

/**
 * If supplied, and the column is exportable, this will be the format when rendering the CSV/XLS/PDF instead of the format() function. You may have both, format() for the UI, and exportFormat() for the export only. If this method is not supplied, format() will be used and passed through strip_tags() to try to clean the output.
 */
public function exportFormat(callable $callable = null) : self;

/**
 * Is the reverse of hideFrom(). Show columns base on the screen size.
 */
public function showOn(string $value): self
```

### Properties

You can override any of these in your table component:

#### Searching

| Property | Default | Usage |
| -------- | ------- | ----- |
| $showSearch | true | Whether or not searching is enabled |
| $searchUpdateMethod | debounce | debounce or lazy |
| $searchDebounce | 350 | Amount of time in ms to wait to send the search query and refresh the table |
| $search | *none* | The initial search string |
| $clearSearchButton | true | Adds a clear button to the search input |

#### Sorting

| Property | Default | Usage |
| -------- | ------- | ----- |
| $sortField | id | The initial field to be sorting by |
| $sortDirection | asc | The initial direction to sort |

#### Pagination

| Property | Default | Usage |
| -------- | ------- | ----- |
| $showPagination | true | Enables or disables pagination as a whole |
| $perPageOptions | [10, 25, 50, 100] | The options to limit the amount of results per page. Set to [] to disable. |
| $perPage | 25 | Amount of items to show per page |

#### Loading

| Property | Default | Usage |
| -------- | ------- | ----- |
| $showLoading | true | Whether or not to show a loading indicator when searching |

#### Offline

| Property | Default | Usage |
| -------- | ------- | ----- |
| $showOffline | true | Whether or not to display an offline message when there is no connection |

#### Exports

| Property | Default | Usage |
| -------- | ------- | ----- |
| $exportFileName | data | The name of the downloaded file when exported |
| $exports | [] | The available options to export this table as (csv, xls, xlsx, pdf) |

#### Other

| Property | Default | Usage |
| -------- | ------- | ----- |
| $refresh | false | Whether or not to refresh the table at a certain interval. false = off, int = ms, string = functionCall |
| $checkboxEnable | true | Enable the checkboxes to make mass assignments |
| $newResource | null | If not empty, will enable the new resource buttom |

### Table Methods

#### Columns/Data

Use the following methods to alter the column/row metadata in the table component for each model.

```php
// Set the custom table head ID.
public function setTableHeadId(?string $attribute): ?string

// Set the the custom table head attributes.
public function setTableHeadAttributes(string | array $attribute): array

// Set the custom table row ID.
public function setTableRowId(?string $model): ?string

// Set the the custom table row attributes.
public function setTableRowAttributes(string | array $model): array

// Set the the custom table column id for the data view.
public function setTableDataId($attribute, $value): ?string

// Set the the custom table column attributes for the data view.
public function setTableDataAttributes($attribute, $value): array
```

For example:

```php
<?php

namespace App\Http\Livewire;

use App\User;
use Daguilarm\LivewireTables\Components\TableComponent;
use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class UsersTable extends TableComponent
{
    public function setTableHeadId(?string $attribute): ?string 
    {
        return 'head-id-' . $attribute;
    }
}
```

#### Filters

You can add filters easily. By default, the package integrate three predesigned filters:

```php 
use Daguilarm\LivewireTables\Components\Filters\FilterByDate;
use Daguilarm\LivewireTables\Components\Filters\FilterByUser;
use Daguilarm\LivewireTables\Components\Filters\FilterByYear;
```

A filter has two different parts, the view and the filter logic. The basic structure for a filter logic, is as follows:

```php 
<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Filters;

use App\Models\User;
use Daguilarm\LivewireTables\Components\FilterComponent;
use Illuminate\Database\Eloquent\Builder;

final class FilterByUser extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->view = 'livewire-tables::'.config('livewire-tables.theme').'.includes.options.filters.user';
        $this->tableColumn = 'id';
        $this->name = $name ?? 'user';
    }

    /**
     * Set the filter query.
     *
     * @param string | int | null $value
     */
    public function query(Builder $model, $value): Builder
    {
        return $model->where(
            $this->tableColumn,
            $value
        );
    }

    /**
     * Set the filter query.
     *
     * @return  array<string>
     */
    public function values(): array
    {
        return User::all()
            ->pluck('name', 'id')
            ->toArray();
    }
}
```

An example of the filter view is:

```html 
<!-- Filter -->
<div class="filter-container">
    <label for="search_filter_worker" class="flex mb-1">
        <div>
            <!-- Icon: heroicon-s-user -->
            <svg class="h-6 w-6 py-1 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
        </div>

        <!-- Filter by user -->
        <div>{{ __('livewire-tables::filters.user') }}</div>
    </label>
    <!-- Select -->
    <select
        id="table_filter_user"
        class="w-full px-10 my-1 py-1.5 shadow-md rounded-md text-gray-500 sm:text-sm focus:outline-none border border-transparent focus:border-gray-300 placeholder-gray-300"
        dusk="table-filter-user"
        wire:model.defer="filterValues.user"
    >
        <option value=""></option>
        @foreach($values as $id => $value)
            <option value="{{ $id }}">{{ $value }}</option>
        @endforeach
    </select>
</div>

```

To use the filters, you need to use the `filters()` method, and load all the classes in the **livewire table component**:

```php
<?php

namespace App\Http\Livewire;

use App\User;
use Daguilarm\LivewireTables\Components\Filters\FilterByDate;
use Daguilarm\LivewireTables\Components\Filters\FilterByUser;
use Daguilarm\LivewireTables\Components\Filters\FilterByYear;
use Daguilarm\LivewireTables\Components\TableComponent;
use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class UsersTable extends TableComponent
{
    public function query() : Builder
    {
        return User::with('role')->withCount('permissions');
    }

    public function columns() : array
    {
        return [
            Column::make('ID')
                ->searchable()
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            FilterByYear::make()->tableColumn('created_at'),
            FilterByUser::make(),
            FilterByDate::make()->tableColumn('created_at'),
        ];
    }
}
```

The properties and methods that filters support are described below:

| Property | Method | Usage |
| -------- | ------- | ----- |
| $name | name() | Set the filter name |
| $tableColumn | tableColumn() | Set the table field to filter |
| $view | view() | Set the filter view to render |

You can create your own filters, for this you must include two mandatory methods:

```php
/**
 * Set the filter query.
 *
 * @param string | int | null $value
 */
abstract public function query(Builder $model, $value): Builder;

/**
 * Sent values for the view.
 *
 * @return  array<string>
 */
abstract public function values(): array;
```

Use the `query()` method to query the database. Remember that it's an instance of `Builder` and not of `Collection`:

```php
/**
 * Set the filter query.
 *
 * @param string | int | null $value
 */
public function query(Builder $model, $value): Builder
{
    return $model->where($this->tableColumn, $value);
}
```

Use the `values()` method, to send an array with the values to be use in the view.

```php
/**
 * Set the filter query.
 *
 * @return  array<string>
 */
public function values(): array
{
    return User::all()
        ->pluck('name', 'id')
        ->toArray();
}
```

or leave blank if your filter doesn't need these extra values:

```php
/**
 * Set the filter query.
 *
 * @return  array<string>
 */
public function values(): array
{
    return [];
}
```

Filters example:

![Tables](https://raw.githubusercontent.com/daguilarm/livewire-tables/master/docs/images/filters.png)

#### Pagination

Override these methods if you want to perform extra tasks when the search or per page attributes change:

```php
public function updatingSearch(): void
public function updatingPerPage(): void
```

#### Search

Override this method if you want to perform extra steps when the search has been cleared:

```php
public function clearSearch(): void
```

#### Sorting

Override this method if you want to change the default sorting behavior:

```php
public function sort($attribute): void
```

### Actions 

You can define actions for your table:

```php
public function columns() : array
{
    return [
        Column::make('ID')
            ->searchable()
            ->sortable(),
        Column::make('Name')
            ->searchable()
            ->sortable(),
        Action::make($routeName = '', $view = 'path/to/view'),
    ];
}
```
It will render something like that:

![Tables](https://raw.githubusercontent.com/daguilarm/livewire-tables/master/docs/images/actions.png)

You can define either of the two parameters, or you can leave them blank and use the default values ​​(which work in most of the cases):

| Parameter | Default | Usage |
| -------- | ------- | ----- |
| $routeName | request()->route()->getName() | In the view can be use to create the links |
| $view | resources/views/vendor/livewire-tables/tailwind/includes/actions/default.blade.php | You can use the default template or crear your own in this default folder. |

The default action view will look like this:

```html
<div class="flex justify-end text-gray-400" >
    {{-- Show button --}}
    <a href="{{-- {{ routeAction($routeName, $routeAction = 'show', $model->id) }} --}}" class="py-2 px-1 hover:text-green-600">
        {{-- icon: heroicon-o-eye --}}
        <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
    </a>

    {{-- Edit button --}}
    <a href="{{-- {{ routeAction($routeName, $routeAction = 'edit', $model->id) }} --}}" class="py-2 px-1 hover:text-blue-600">
        {{-- icon: heroicon-o-pencil-alt --}}
        <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
    </a>

    {{-- Delete button --}}
    <livewire:delete-button-component :model="$model" :key="time().$model->id"/>
</div>
```

The default blade action, includes all the logic for delete items using a confirmation modal. But you can create your own in your custom action. In this case, the delete button is inside a livewire container, but you can do whatever you want...

![Tables](https://raw.githubusercontent.com/daguilarm/livewire-tables/master/docs/images/delete-modal.png)

#### Mass assignments

You can enable or disable the checkboxes using the variable `$checkboxEnable`, using this, you can show or hide the checkboxes:

![Tables](https://raw.githubusercontent.com/daguilarm/livewire-tables/master/docs/images/checkboxes.png)

When a checkbox is activated, the mass action buttons automatically appear. By default, the hability to delete the selected elements.

![Tables](https://raw.githubusercontent.com/daguilarm/livewire-tables/master/docs/images/mass-delete.png)

You can show or hide buttons base on the selected checkboxes, using this logic:

```php
@includeWhen($checkboxValues, 'livewire-tables::path.to.your.view')
```

#### New resources 

You can add a button for *add new resource*, using the parameter `$newResource` in you table component:

```php
<?php

namespace App\Http\Livewire;

use App\User;
use Daguilarm\LivewireTables\Components\Filters\FilterByDate;
use Daguilarm\LivewireTables\Components\Filters\FilterByUser;
use Daguilarm\LivewireTables\Components\Filters\FilterByYear;
use Daguilarm\LivewireTables\Components\TableComponent;
use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class UsersTable extends TableComponent
{
    public string $newResource = '../../dashboard/users/create';

    public function query() : Builder
    {
        return User::with('role')->withCount('permissions');
    }
}
```

The `$newResource` will render in the view:

```html
<a
    href="{{ $newResource }} "
    type="button"
    class="inline-flex ml-2 mt-3 items-center p-2 shadow-lg rounded-lg text-blue-400 hover:text-white bg-white hover:bg-blue-400 focus:outline-none"
>
    <!-- Heroicon name: solid/mail -->
    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
    </svg>
</a>
```

### Exporting Data

The table component supports exporting to CSV, XLS, XLSX, and PDF.

In order to use this functionality you must install [Laravel Excel](https://laravel-excel.com) 3.1 or newer.

In order to use the PDF export functionality, you must also install either [DOMPDF](https://github.com/dompdf/dompdf) or [MPDF](https://github.com/mpdf/mpdf).

You may set the PDF export library in the config file under **pdf_library**. DOMPDF is the default.

#### What exports your table supports

By default, exporting is off. You can add a list of available export types with the $exports class property.

`public $exports = ['csv', 'xls', 'xlsx', 'pdf'];`

#### Defining the file name.

By default, the filename will be `data`.*type*. I.e. `data.pdf`, `data.csv`.

You can change the filename with the `$exportFileName` class property.

`public $exportFileName = 'users-table';` - *Obviously omit the file type*

#### Deciding what columns to export

You have a couple option on exporting information. By default, if not defined at all, all columns will be exported.

If you have a column that you want visible to the UI, but not to the export, you can chain on `excludeFromExport()`

If you have a column that you want visible to the export, but not to the UI, you can chain on `exportOnly()`

#### Formatting column data for export

By default, the export will attempt to render the information just as it is shown to the UI. For a normal column based attribute this is fine, but when exporting formatted columns that output a view or HTML, it will attempt to strip the HTML out.

Instead, you have available to you the `exportFormat()` method on your column, to define how you want this column to be formatted when outputted to the file.

So you can have a column that you want both available to the UI and the export, and format them differently based on where it is being outputted.

#### Exporting example

```php
<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Daguilarm\LivewireTables\Components\TableComponent;
use Daguilarm\LivewireTables\Views\Column;

class UsersTable extends TableComponent
{
    public function query() : Builder
    {
        return User::with('role')->withCount('permissions');
    }

    public function columns() : array
    {
        return [
            Column::make('ID')
                ->searchable()
                ->sortable()
                ->excludeFromExport(), // This column is visible to the UI, but not export.
            Column::make('ID')
                ->exportOnly(), // This column is only rendered on export
            Column::make('Avatar')
                ->format(function(User $model) {
                    return $this->image($model->avatar, $model->name, ['class' => 'img-fluid']);
                })
                ->excludeFromExport(), // This column is visible to the UI, but not export.
            Column::make('Name') // This columns is visible to both the UI and export, and is rendered the same
                ->searchable()
                ->sortable(),
            Column::make('E-mail', 'email')
                ->searchable()
                ->sortable()
                ->format(function(User $model) {
                    return $this->mailto($model->email, null, ['target' => '_blank']);
                })
                ->exportFormat(function(User $model) { // This column is visible to both the UI and the export, but is formatted differently to the export via this method.
                    return $model->email;
                }),
            Column::make('Role', 'role.name') // This columns is visible to both the UI and export, and is rendered the same
                ->searchable()
                ->sortable(),
            Column::make('Permissions') // This columns is visible to both the UI and export, and is rendered the same, except the HTML tags will be removed because it is not specifically calling a exportFormat() function.
                ->sortable()
                ->format(function(User $model) {
                    return $this->html('<strong>'.$model->permissions_count.'</strong>');
                }),
            Column::make('Actions')
                ->format(function(User $model) {
                    return view('backend.auth.user.includes.actions', ['user' => $model]);
                })
                ->hideIf(auth()->user()->cannot('do-this'))
                ->excludeFromExport(), // This column is visible to the UI, but not export.
        ];
    }
}
```

#### Customizing Exports

Currently, there are no customization options available. But there is a config item called `exports` where you can define the class to do the rendering. You can use the `\Daguilarm\LivewireTables\Exports\Export` class as a base.

More options will be added in the future, but the built in options should be good for most applications.

### Setting Component Options

There are some frontend framework specific options that can be set.

These have to be set from the `$options` property of your component.

They are done this way instead of the config file that way you can have per-component control over these settings.

```php
protected $options = [
    // The class set on the table when using bootstrap
    'bootstrap.classes.table' => 'table table-striped table-bordered',

    // The class set on the table's thead when using bootstrap
    'bootstrap.classes.thead' => null,

    // The class set on the table's export dropdown button
    'bootstrap.classes.buttons.export' => 'btn',
    
    // Whether or not the table is wrapped in a `.container-fluid` or not
    'bootstrap.container' => true,
    
    // Whether or not the table is wrapped in a `.table-responsive` or not
    'bootstrap.responsive' => true,
];
```

For this to work you have to pass an associative array of overrides to the `$options` property. The above are the defaults, if you're not changing them then you can leave them out or disregard the property all together.

### Passing Properties

To pass properties from your blade view to your table, you can use the normal Livewire mount method:

```php
<livewire:users-table status="{{ request('status') }}" />
```

```php
protected $status = 'active';

public function mount($status) {
    $this->status = $status;
}
```

## Other utilities 

### Flash messages 

Livewire tables use https://github.com/mattlibera/livewire-flash for flash messages, so you can use it in your own livewire components:

```php
flash('success message...')->success()->livewire($this);
flash('warning message...')->warning()->livewire($this);
flash('error message...')->error()->livewire($this);
```

![Tables](https://raw.githubusercontent.com/daguilarm/livewire-tables/master/docs/images/flash-messages.png)

### Custom javascript and css 

You can add your own custom javacript or css from any view, pushing the default named stacks:

```php
@push('livewire-tables-javascript')
    console.log('hello world');
@endpush

@push('livewire-tables-css')
    .customClass{margin:1px;}
@endpush
```

The template looks like this:

```html
<!-- Css classes -->
<style>
    /* Css if needed */
    @stack('livewire-tables-css')
</style>

<!-- Javascript if needed -->
<script>
    @stack('livewire-tables-javascript')
</script>
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email damian.aguilarm@gmail.com instead of using the issue tracker.

## Credits

- [Anthony Rappa](https://github.com/rappasoft)
- [Damián Aguilar](https://github.com/daguilarm)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
