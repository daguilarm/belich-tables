# Delete Modal

This modal will allow you to eliminate individual elements and bulk elements (in the case you select multiples elements through the checkboxes). When you click on the delete button, the following modal shows:

![livewire-tables](../../_media/delete-modal.png ':class=thumbnail')

The **HTML** code is shown below, and you can find it in `./tailwind/includes/modals/delete-modal.blade.php`:

```html 
<div
    class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-gray-200 bg-opacity-75"
    x-show="showModal"
    x-transition:enter="transform duration-200"
    x-transition:enter-start="opacity-0 scale-100"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transform duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-100"
    x-cloak
>
    {{-- Modal inner --}}
    <div
        class="w-auto px-6 py-4 mx-auto"
        @click.away="showModal = false"
    >
        <div class="relative rounded-xl border border-gray-200 shadow-lg bg-gray-50 p-4">

            {{-- Close button --}}
            <div class="absolute top-1 right-1">
                <button type="button" class="inline-flex p-1.5 focus:outline-none">
                    <span class="sr-only">Dismiss</span>
                    {{-- Heroicon name: solid/x-circle --}}
                    <svg @click="showModal = false" class="h-5 w-5 text-gray-400 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            {{-- Title --}}
            <div class="flex mt-6 mb-6 px-4">

                {{-- Heroicon name: solid/check-circle --}}
                <svg class="h-8 w-8 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>

                {{-- Title message --}}
                <div class="ml-3">
                    <h1 class="text-xl font-medium text-gray-700">
                        @lang('livewire-tables::strings.delete.title')
                    </h1>
                </div>
            </div>

            <div class="p-6 text-md bg-red-50 text-red-600 border-t border-b border-red-200">
                <li>@lang('livewire-tables::strings.delete.message')</li>
            </div>

            <div class="flex justify-center mt-8 mb-4">
                <button
                    type="button"
                    class="flex justify-center py-1 px-4 border border-transparent text-xl font-medium rounded shadow-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                    @click="showModal = false"
                    wire:click.prevent="{{ $onclick }}"
                >
                    {{-- Trash icon --}}
                    <svg class="h-5 w-5 mr-1 mt-1 text-white opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>

                    {{-- Button text --}}
                    <div>@lang('livewire-tables::strings.delete.button')</div>
                </button>
            </div>
        </div>
    </div>
</div>
```

This modal is versatile one, and as has been commented before, it serves both to eliminate one element and several elements, for this, it has a dynamic component that allows including the necessary `javascript` code depending on the case:

```javascript
wire:click.prevent="{{ $onclick }}"
```

The code used to remove a single item is:

```php
@include(LivewireTables::include('includes.modals.delete-modal'), [
    'onclick' => 'itemDelete('.$userId.')'
])
```

The code used to remove multiple items is:

```php
@include(LivewireTables::include('includes.modals.delete-modal'), [
    'onclick' => 'bulkDelete()'
])
```

In this last case, the selected elements are obtained from the selected *checkboxes*, so it is not necessary to define the elements by their `ID`, as was done in the first case.
