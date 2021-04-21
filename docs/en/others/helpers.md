# Helpers

The package has some extra methods that can be useful to us. These methods are accessible through the *Facade* `LivewireTables`.

| Method | Example | Description |
| :---------- |:------------ |:------------|
| include | `LivewireTables::include('path.to.view')`| It's a shortcut for `livewire-tables::'.config('livewire-tables.theme').'.path.to.view` |
| noResults | `LivewireTables::noResults()`| Used to assign the default value when there are no search results found in `config('livewire-tables.noResults')` |
