# Creating Tables

The tables are the elements that will allow us to show the data from a **Laravel** model. For it you will need a new **Livewire** component that extends the **TableComponent**, in this component, you need to define a list of a columns, a base query, the filters and the configuration parameters.

Combining all these parameters, we will be able to configure the table according to our requirements.

## Basic requirements

The table, will need to extend the class `Daguilarm\LivewireTables\Components\TableComponent` this class establishes some parameters by default and forces you to include a series of classes in your table. These three classes are:

### The query() method 

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

!> It is important to note that we must create an instance of `\Illuminate\Database\Eloquent\Builder`.

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
?> If we are using models with relationships, it is important to define the attributes as in the previous example: `table.attribute`, to avoid problems when ordering the results. 
