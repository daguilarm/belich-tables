# Creating Tables

The tables are the elements that will allow us to show the data from a **Laravel** model. For it you will need a new **Livewire** component that extends the **TableComponent**, in this component, you need to define a list of a columns, a base query, the filters and the configuration parameters.

Combining all these parameters, we will be able to configure the table according to our requirements.

## Basic requirements

The table, will need to extend the class `Daguilarm\LivewireTables\Components\TableComponent` this class establishes some parameters by default and forces you to include a series of classes in your table. These three classes are:

## query()

The `query()` method will allow us to show the results of the database in our table. The structure of the method is as follows:

```php
/**
 * Set the query builder.
 */
public function query(): Builder
{
    //some code...
};
```

!> It is important to note that you must create an instance of `\Illuminate\Database\Eloquent\Builder`.

Let's see a working example:

```php
/**
 * Set the query builder.
 */
public function query(): Builder
{
    return User::select(['users.id', 'user.name', 'user.email'])->with('profile');
};
```
?> If we are using models with relationships, it is important to define the attributes as in the previous example: `table.attribute`, to avoid problems when ordering the results. So you must use, for example: `users.id` instead of `id`.

## columns()

This method will allow us to configure the columns of the table, and how they will be displayed. The structure of the method is as follows:

```php
public function columns() : array
{
    return [
        Column::make('ID', 'user.id')
            ->sortable(),
        Column::make('Name', 'user.name')
            ->searchable()
            ->sortable()
            ->format(static function($value) {
                return Str::of($value)->title();
            }),
    ];
}
```
Later, in the point on [Columns](en/basics/columns.md), all the available options and methods will be discussed in depth. Now, let's focus on the basics.

Each column is initialized with a `make()` method, which supports two parameters: the name and the database column. In the next example you can see it in detail:

```php
Column::make('Email', 'users.email').
```

It may also be the case that both parameters coincide (as in the previous example), in this case, it is not necessary to add the second parameter, because this will be generated automatically:

```php
Column::make('Email').
```

?> It is advisable to always use both parameters, and leave magic aside.

## filters()

From here we can load all the filters that we want to apply to each table. Let's see an example, using the predefined filters:

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

Later, in the point on [Filters](en/basics/filters.md), all the available options and methods will be discussed in depth. **If we don't want to add filters, we must return an empty array**:

```php
public function filters(): array
{
    return [];
}
```

!> **Remember!!!** the three methods are mandatory.
