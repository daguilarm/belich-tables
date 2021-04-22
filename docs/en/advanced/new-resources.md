# Create new resources

As commented on [Attributes](en/basics/attributes.md), there is a way to add a  *add-new-resource-button* to the model shown in the table. This button looks like this (at the top right of the image):

![livewire-tables](../../../_media/new-resource.png ':class=thumbnail-full')

To activate it, we will only have to go to our *Table Component*, and add the attribute `$newResource` with the url path or a route:

```php 
<?php

namespace App\Http\Livewire;

use App\Models\User;
use Daguilarm\LivewireTables\Components\TableComponent;
use Daguilarm\LivewireTables\Views\Action;
use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;


class UsersTable extends TableComponent
{
    public string $newResource = '../../dashboard/users/create';

    // Some code ...
}
```

Or if you prefer, you can pass the url using a route:

```php 
<?php

namespace App\Http\Livewire;

use App\Models\User;
use Daguilarm\LivewireTables\Components\TableComponent;
use Daguilarm\LivewireTables\Views\Action;
use Daguilarm\LivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;


class UsersTable extends TableComponent
{
    /**
     * Table constructor.
     */
    public function __construct(?string $id = null)
    {
        parent::__construct($id);


        $this->newResource = route('dashboard.users.create');
    }

    // Some code ...
}
```

The button will only be activated (and visible), if there is a url associated to the attribute `$newResource`.
