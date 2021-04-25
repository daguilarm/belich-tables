# Bulk delete

**Belich Tables** allows us to eliminate simultaneously all the elements that are selected in the table, through the checkboxes.

![Belich Tables with Livewire](../../_media/bulk-delete.png ':class=thumbnail')

After pushing on the **Bulk Delete** button, a **Dialog** will appear with the confirmation message.

![Belich Tables with Livewire](../../_media/delete-modal.png ':class=thumbnail')

Below you can see the content of the file `views/vendor/belich-tables.tailwind.resources.options.bulk-delete.blade.php`.

```html
<!-- Mass delete button -->
<div
    id="delete_mass_button"
    dusk="delete-mass-button"
    x-data="{ 'showModal': false }"
    @keydown.escape="showModal = false"
    class="hidden md:block"
>
    <!-- Button -->
    <button
        type="button"
        class="inline-flex ml-2 mt-3 items-center p-2 shadow-lg rounded-lg text-red-400 hover:text-white bg-white hover:bg-red-400 focus:outline-none"
        id="options-menu"
        @click="showModal = true"
    >
        <!-- icon: heroicon-s-trash -->
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
    </button>

    <!-- Delete Dialog -->
    @include(BelichTables::include('resources.dialogs.delete-elements'), ['onclick' => 'bulkDelete'])
</div>
```
