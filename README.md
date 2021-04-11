![Package Logo](https://banners.beyondco.de/Livewire%20Tables.png?theme=light&packageManager=composer+require&packageName=daguilarm%2Flivewire-tables&pattern=bamboo&style=style_1&description=Manage+your+tables+with+Laravel+Livewire&md=1&showWatermark=0&fontSize=100px&images=template)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/daguilarm/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/daguilarm/livewire-tables)
[![StyleCI](https://styleci.io/repos/354914653/shield?style=plastic)](https://github.styleci.io/repos/354914653)
[![Total Downloads](https://img.shields.io/packagist/dt/daguilarm/livewire-tables.svg?style=flat-square)](https://packagist.org/packages/daguilarm/livewire-tables)
![GitHub last commit](https://img.shields.io/github/last-commit/daguilarm/livewire-tables)


> :warning: **This package is currently under development**: Be very careful here!


**This package is base on the https://github.com/rappasoft/laravel-livewire-tables package. Since there seems to be no mayor updates or improvements, I have decided to proceed with this package on my own.**

A dynamic Laravel Livewire component for data tables.

This plugin assumes you already have [Laravel Livewire](https://laravel-livewire.com/) installed and configured in your project.

## Usage

### Creating Tables

To create a table component you draw inspiration from the below stub:

```php
<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends TableComponent
{
    use HtmlComponents;

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
            Column::make('Avatar')
                ->format(function(User $model) {
                    return $this->image($model->avatar, $model->name, ['class' => 'img-fluid']);
                }),
            Column::make('Name')
                ->searchable()
                ->sortable(),
            Column::make('E-mail', 'email')
                ->searchable()
                ->sortable()
                ->format(function(User $model) {
                    return $this->mailto($model->email, null, ['target' => '_blank']);
                }),
            Column::make('Role', 'role.name')
                ->searchable()
                ->sortable(),
            Column::make('Permissions')
                ->sortable()
                ->format(function(User $model) {
                    return $this->html('<strong>'.$model->permissions_count.'</strong>');
                }),
            Column::make('Actions')
                ->format(function(User $model) {
                    return view('backend.auth.user.includes.actions', ['user' => $model]);
                })
                ->hideIf(auth()->user()->cannot('do-this')),
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

Place the following where you want the table to appear.

Laravel 6.x: 

`@livewire('users-table')`

Laravel 7.x|8.x:

`<livewire:users-table />`

### Defining Columns

You can define the columns of your table with the column class.

The following methods are available to chain to a column:

```php

/**
 * The first argument is the column header text
 * The attribute can be omitted if the text is equal to the lower case snake_cased version of the column
 * The attribute can also be used to reference a relationship (i.e. role.name)
 */
public function make($text, ?$attribute) : Column;

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
```

### Properties

You can override any of these in your table component:

#### Searching

| Property | Default | Usage |
| -------- | ------- | ----- |
| $searchEnabled | true | Whether or not searching is enabled |
| $searchUpdateMethod | debounce | debounce or lazy |
| $searchDebounce | 350 | Amount of time in ms to wait to send the search query and refresh the table |
| $disableSearchOnLoading | false | Whether or not to disable the search bar when it is searching/loading new data | 
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
| $paginationEnabled | true | Enables or disables pagination as a whole |
| $perPageOptions | [10, 25, 50, 100] | The options to limit the amount of results per page. Set to [] to disable. |
| $perPage | 25 | Amount of items to show per page |

#### Loading

| Property | Default | Usage |
| -------- | ------- | ----- |
| $loadingIndicator | true | Whether or not to show a loading indicator when searching |

#### Offline

| Property | Default | Usage |
| -------- | ------- | ----- |
| $offlineIndicator | true | Whether or not to display an offline message when there is no connection |

#### Exports

| Property | Default | Usage |
| -------- | ------- | ----- |
| $exportFileName | data | The name of the downloaded file when exported |
| $exports | [] | The available options to export this table as (csv, xls, xlsx, pdf) |

#### Other

| Property | Default | Usage |
| -------- | ------- | ----- |
| $refresh | false | Whether or not to refresh the table at a certain interval. false = off, int = ms, string = functionCall |

### Table Methods

#### Columns/Data

Use the following methods to alter the column/row metadata.

```php
public function setTableHeadClass($attribute): ?string
public function setTableHeadId($attribute): ?string
public function setTableHeadAttributes($attribute): array
public function setTableRowClass($model): ?string
public function setTableRowId($model): ?string
public function setTableRowAttributes($model): array
public function getTableRowUrl($model): ?string
public function setTableDataClass($attribute, $value): ?string
public function setTableDataId($attribute, $value): ?string
public function setTableDataAttributes($attribute, $value): array
```

#### Actions 

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
        Action::make($model = User::class, $routeName='', $view = 'actions.default'),
    ];
}
```

You need to define three parameters:

| Parameter | Default | Usage |
| -------- | ------- | ----- |
| $model | mandatory parameter | You need to define the model class: \App\Models\User::class |
| $routeName | request()->route()->getName() | In the view can be use to create the links |
| $view | resources/views/vendor/livewire-tables/tailwind/includes/actions/default.blade.php | You can use the default template or crear your own in this default folder. |

![Tables](https://raw.githubusercontent.com/daguilarm/livewire-tables/master/docs/images/actions.png)

The default action view:

```html
<div class="flex justify-end text-gray-400" >
    {{-- Show button --}}
    <a href="{{ routeAction($routeName, $routeAction = 'show', $model->id) }}" class="py-2 px-1 hover:text-green-600">
        {{-- icon: heroicon-o-eye --}}
        <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
    </a>

    {{-- Edit button --}}
    <a href="{{ routeAction($routeName, $routeAction = 'edit', $model->id) }}" class="py-2 px-1 hover:text-blue-600">
        {{-- icon: heroicon-o-pencil-alt --}}
        <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
    </a>

    {{-- Delete button --}}
    <div
        class="py-2 px-1 text-gray-300 hover:text-red-600"
        x-data="{ 'showModal': false, 'itemId': {{ $model->id }} }"
        @keydown.escape="showModal = false"
    >
        <a
            href="javascript:void(0)"
            @click="showModal = true"
        >
            {{-- icon: heroicon-o-trash --}}
            <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </a>

        {{-- Delete Modal --}}
        @include('livewire-tables::'.config('livewire-tables.theme').'.includes.modals.delete-modal')
    </div>
</div>
```
You can use the function `routeAction()` to create the action links base on the route:

```php
/**
 * Get the route base on the action.
 */
if (! function_exists('routeAction')) {
    function routeAction(string $root, string $action, int $id): string
    {
        return route(sprintf('%s.%s', $root, $action), $id);
    }
}
```

The default blade action, includes all the logic for delete items using a modal. But you can create your own in your custom action.

#### Pagination

Override these methods if you want to perform extra tasks when the search or per page attributes change.

```php
public function updatingSearch(): void
public function updatingPerPage(): void
```

#### Search

Override this method if you want to perform extra steps when the search has been cleared.

```php
public function clearSearch(): void
```

#### Sorting

Override this method if you want to change the default sorting behavior.

```php
public function sort($attribute): void
```

### HTML Components

This package includes some of the functionality from the laravelcollective/html package modified to fit the needs of this package.

To use these you must import the *Rappasoft\LaravelLivewireTables\Traits\HtmlComponents* trait.

You may return any of these functions from the format() method of a column, for example:

```php
Column::make('Permissions')
   ->format(function(User $model) {
       return $this->html('<strong>'.$model->permissions_count.'</strong>');
   })
```

The complete list of functions:

```php
public function image($url, $alt = null, $attributes = [], $secure = null): HtmlString
public function link($url, $title = null, $attributes = [], $secure = null, $escape = true): HtmlString
public function secureLink($url, $title = null, $attributes = [], $escape = true): HtmlString
public function linkAsset($url, $title = null, $attributes = [], $secure = null, $escape = true): HtmlString
public function linkSecureAsset($url, $title = null, $attributes = [], $escape = true): HtmlString
public function linkRoute($name, $title = null, $parameters = [], $attributes = [], $secure = null, $escape = true): HtmlString
public function linkAction($action, $title = null, $parameters = [], $attributes = [], $secure = null, $escape = true): HtmlString
public function mailto($email, $title = null, $attributes = [], $escape = true): HtmlString
public function email($email): string
public function html($html): HtmlString
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
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends TableComponent
{
    use HtmlComponents;

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

Currently, there are no customization options available. But there is a config item called `exports` where you can define the class to do the rendering. You can use the `\Rappasoft\LaravelLivewireTables\Exports\Export` class as a base.

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
