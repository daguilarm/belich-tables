# Helpers

**Belich Tables** has some extra methods that can be useful to us. These methods are accessible through the *Facade* `LivewireTables`.

| Method | Example | Description |
| :---------- |:------------ |:------------|
| include | `BelichTables::include('path.to.view')`| It's a shortcut for `belich-tables::'.config('belich-tables.theme').'.path.to.view` |
| noResults | `BelichTables::noResults()`| Used to assign the default value when there are no search results found in `config('belich-tables.noResults')` |
