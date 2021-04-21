# Filters

The filters will allow us to show a more precise results, discarding those that do not fill with the established criteria. Each filter consists of two parts: the **Filter Component** and the **Blade view**. Let's first look at the basics of the **Filter Component**.

## Component 

Let's see a complete example of what a Filter Component would look like:

```php
<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Filters;

use App\Models\User;
use Daguilarm\LivewireTables\Components\FilterComponent;
use Daguilarm\LivewireTables\Facades\LivewireTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByUser extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->view = 'livewire-tables.includes.options.filters.user';
        $this->name = 'user';
        $this->tableColumn = 'id';
    }

    /**
     * Set the filter query.
     *
     * @param int | float | string | null $value
     */
    public function query(Builder $model, $value): Builder
    {
        return $model->where(
            $this->getColumn($model),
            $value,
        );
    }

    /**
     * Set the filter query.
     *
     * @return  array<string>
     */
    public function values(): array
    {
        return User::select('users.id', 'users.name')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }
}
```

Let's see in detail, the three parts in which the component can be divided.

### __construct()

In the constructor we will have to define several attributes:

| Attribute | Example | Description |
| :---------- |:------------| :------------|
| $view | `$this->view ='path.to.the.filter.view'` | Defines the location where the view is located. |
| $name | `$this->name = 'user'` | Define the filter name. |
| $tableColumn | `$this->tableColumn = 'id'` | Defines the field in the table on which the filter action will be performed. It is important not to add the name of the table to the name of the column, for example: `users.id`, since this operation is already done by the`getColumn($model)` method automatically (as it will look later). |

In the example above, the constructor part would look like this:

```php
/**
 * Create a new field.
 */
public function __construct(?string $name = null)
{
    parent::__construct($name);

    $this->view = 'livewire-tables.includes.options.filters.user';
    $this->name = 'user';
    $this->tableColumn = 'id';
}
```

### query()

It is the filter itself. It is about defining the search in the database.

```php
/**
 * Set the filter query.
 *
 * @param int | float | string | null $value
 */
public function query(Builder $model, $value): Builder
{
    return $model->where(
        $this->getColumn($model),
        $value,
    );
}
```
!> It is important to note that we must create an instance of `\Illuminate\Database\Eloquent\Builder`.

The `getColumn ()` method is available as a helper when we want to use the name of the table column.

| Method | Example | Description |
| :---------- |:------------| :------------|
| getColumn() | `$this->getColumn($model)` | It is used to call the database column automatically and in a homogenized way. **It is recommended to use this method instead of the column name.** |

?> It is important to use the method `getColumn()`, since it will allow us to homogenize the code and thus avoid problems with the database when we use related tables.

### values()

It is used to return the array with the filter options to the view. In this case, the values ​​have been obtained directly from the database, but they can be sent directly in an `array` without database.

```php
/**
 * Set the filter query.
 *
 * @return  array<string>
 */
public function values(): array
{
    return User::select('users.id', 'users.name')
        ->orderBy('name')
        ->pluck('name', 'id')
        ->toArray();
}
```

Or you can just return an `array` with values:

```php
/**
 * Set the filter query.
 *
 * @return  array<string>
 */
public function values(): array
{
    return [
        'guest', 
        'user', 
        'editor', 
        'admin', 
        'super-admin'
    ];
}
```

!> It is important to note that you must return an `array`.

## View

Let's see a complete example of what a view would look like:

```html
<!-- Filter -->
<div class="filter-container">
    <label for="search_filter_user" class="flex mb-1">
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
        <!-- Default value -->
        <option value=""></option>
        <!-- Values from the values() method -->
        @foreach($filter->values() as $id => $value)
            <option value="{{ $id }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
```

It is important that the name of the filter that we asign in the **Filter Component** is the same as the one that we define in the view:

```javascript
wire:model.defer="filterValues.filterName"
```

## Default filters

The package includes by default three filters:

| Filter | Class | Description |
| :---------- |:------------| :------------|
| FilterByDate | `Daguilarm\LivewireTables\Components\Filters\FilterByDate:class` | It is used to filter between two dates or between only one, in the selected column. |
| FilterByUser| `Daguilarm\LivewireTables\Components\Filters\FilterByUser:class` | It is used to filter the users in the database. |
| FilterByYear| `Daguilarm\LivewireTables\Components\Filters\FilterByYear:class` | It is used to filter the results base on the year. |

An example of the default filters in action:

![livewire-tables](../../../_media/default-filters.png ':class=thumbnail')

In the next section, it is explained how to customize the default filters.

## Customize filters

As commented in the section [Creating Tables](en/basics/table-components.md), the filters are defined in the **Table Component**, using the method `filters()`. Let's take a look at the example that was used in the section:

```php
public function filters(): array
{
    return [
        FilterByUser::make(),
        FilterByYear::make()->tableColumn('created_at'),
        FilterByDate::make()->tableColumn('created_at'),
    ];
}
```

To customize the default filters, or our own custom filters, we have at our disposal two methods:

| Filter | Example | Description |
| :---------- |:------------| :------------|
| tableColumn() | `FilterByYear::make()->tableColumn('created_at')` | With this method, we can determine on which column of the table the filter will do its *magic*. |
| view() | `FilterByYear::make()->view('path.to.my.view')` | This method allows us to directly define our custom view. For example, in case we want to change the view in the predefined filters. |

To create your own filters, you will only have to create the two necessary files: the **component** and the **view**.
