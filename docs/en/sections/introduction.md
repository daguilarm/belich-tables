# Introduction

**Belich tables** allows you to adding custom sections that are activated when there are *checkboxes* selected in the table. By default, the *package* includes two pre-configured and fully operational sections:

- [Bulk delete](en/sections/bulk-delete.md).
- [Export data to file](en/sections/export.md).

The package inject into the **Blade** file the variable `$checkboxValues`, which is a boolean that can return `TRUE` or `FALSE` based on whether or not items are selected.

The **Blade** file that manages the different options that can be added, is located in: `views/vendor/belich-tables/tailwind/includes/options.blade.php`.
In this file, we will find the code that includes the two default sections that the *package* includes:

```html 
<!-- Add export button -->
@includeWhen($checkboxValues && count($exports) > 0, BelichTables::include('includes.options.export'))

<!-- Add mass delete button (only if there is checkboxes checked) -->
@includeWhen($checkboxValues, BelichTables::include('includes.options.bulk-delete'))
```

Now you just have to create your custom **Blade** file with all the necessary logic to create the section you need. Below is an example of how a section could be integrated:

```html 
<!-- Add new section -->
@includeWhen($checkboxValues, BelichTables::include('includes.options.new-section'))
```

And the **Blade** view:

```html 
<!-- New section Button -->
<button
    type="button"
    class="inline-flex ml-2 mt-3 items-center p-2 shadow-lg rounded-lg text-red-400 hover:text-white bg-white hover:bg-red-400 focus:outline-none"
    id="new-section"
    dusk="new_section"
    @click="someActionHere()"
>
    <!-- Include here some icon or ... -->
    <x-heroicon-o-some-icon />
</button>
```
