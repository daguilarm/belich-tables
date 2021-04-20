# Columns

Let's take a cloused look at the methods available for `\Daguilarm\LivewireTables\Views\Column::class`. 
Let's start with the general methods:

| Method | Example | Description |
| :---------- |:------------| :-----------| 
|asHtml() | `Column::make('email')->asHtml()` | It allows us to show the result as if it were pure html, that is, the code without escaping. This method is often associated with `format()`. |
| format() | `format(static function($value) {return $value;})` | It allows us to format the data output. This includes the use of `HTML` elements. In these cases you must also add the method `asHtml()`. |
| searchable() | `Column::make('ID')->searchable()` | This method will allow our column to be included in the search results from the package. |
| sortable() | `Column::make('ID')->sortable()` | This method will allow us to sort the results of each column in ascending or descending order. | 

There are also methods to show and hide content:

| Method | Example | Description |
| :---------- |:------------| :-----------| 
| hide() | `Column::make('email')->hide()` | The method hides the entire column. |
| hideIf() | `Column::make('email')->hideIf(auth()->user()->role !== 'admin')` | It allows us to hide content based on a condition. The method hide the column if the condition is met. |

We can also hide or show content depending on the screen size:


| Method | Example | Description |
| :---------- |:------------| :-----------| 
| hideFrom() | `Column::make('email')->hideFrom('xl')` | We can hide the column depending on the size of the screen. For this, the size system used by TailwindCSS has been used. In this specific case, it will add to the `class` attribute, the classes: `block xl:hidden`.  |
| showOn() | `Column::make('email')->showOn('md')` | It works in the opposite way to the previous one. In this specific case, it will add to the `class` attribute, the classes: `hidden md:block`. |

?> The available options are: `sm`, `md`, `lg` and `xl`.

And finally, we leave the method that will allow us to add custom views to the column. This method will be able to manage the design using `Blade`.

| Method | Example | Description |
| :---------- |:------------| :-----------| 
| render() | `Column::render(static function(object $model) {return view('myView', compact('model'));})` | This method allows us to include a view directly in the column. |

## Render()

This method needs a more detailed explanation. And the best way to understand it is with a complete example, showing the component and the view. Let's start with the component:

```php 
public function columns() : array
{
    return [
        Column::make('ID')
            ->searchable()
            ->sortable(),
        Column::make('Name')
            ->searchable()
            ->sortable()
            ->format(static function($value) {
                return Str::of($value)
                    ->title();
            })
            ->hideFrom('lg'),
        Column::make('Profile', 'profile.profile_telephone')
            ->searchable()
            ->sortable()
            ->render(static function(User $user) {
                return view('dashboard.user.profile', compact('user'));
            }),
        Column::make('E-mail', 'email')
    ];
}
```

Now we need the view `resources\views\dashboard\user\profile.blade.php`.

```html 
<div class="flex items-center">
    <div class="flex-shrink-0 h-10 w-10">
        <img
            class="h-10 w-10 rounded-full"
            src="https://randomuser.me/api/portraits/thumb/men/{{ rand(1, 100) }}.jpg"
            alt=""
        >
    </div>
    <div class="ml-4">
        <div class="text-sm font-medium text-gray-900">
            {{ $user->name }}
        </div>
        <div class="text-sm text-gray-500">
            {{ $user->email }}
        </div>
    </div>
</div>
```

?> The `render()` method automatically calls the `asHtml()` method, so there is no need to do it again.
