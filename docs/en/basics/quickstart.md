# Quickstart

## Livewire Component

To create a table component you may draw inspiration from the below stub:

```php 
<?php

namespace App\Http\Livewire;

use App\User;
use Daguilarm\BelichTables\Components\TableComponent;
use Daguilarm\BelichTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class UsersTable extends TableComponent
{
    public function query(): Builder
    {
        return User::with('role')
            ->withCount('permissions');
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
                }),
            Column::make('Avatar', 'profile.profile_avatar')
                ->searchable()
                ->sortable()
                ->render(function(User $user) {
                    return view('profile.avatar', compact('user'));
                }),
            Action::make(),
        ];
    }
}
```

## Route

You need to create this file in the folder `app\Http\Livewire`. Now you need to create a rute for this table:

```php
Route::get('/dashboard/users', function () {
    return view('dashboard.users-table');
})->name('dashboard.users');
```
Of course, you can do this from a `Controller`, but this is a first aproch to **Belich Tables**.

## Blade Component

In the view, you will need to call the `Livewire Component`:

```html
<livewire:users-table /> 
```

If you are testing the abobe example, remember that you need to create the view: `profile.avatar`, because is rendering directly from the `Table Component`:

```php 
Column::make('Avatar', 'profile.profile_avatar')
    ->searchable()
    ->sortable()
    ->render(function(User $user) {
        return view('profile.avatar', compact('user'));
    })
```

And this is the result:

![Belich Tables with Livewire](../../_media/belich-tables.png ':class=thumbnail')

## Flash messages

**Livewire Tables** include the package: [Livewire Flash by Mattlibera](https://github.com/mattlibera/livewire-flash). This package allows us to incorporate flash messages through Livewire, in a very simple way. Some parts of the package use this functionality, so it is convenient to activate it.

To do this, you need to add the `flash-container` component:

```html
<livewire:flash-container />
<livewire:users-table />
```

!>If you do not add this component, the messages will not appear when certain tasks were completed.
