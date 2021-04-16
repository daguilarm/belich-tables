<div class="sm:mt-3 flex w-400 justify-end">
    <!-- Text -->
    <div class="flex items-center text-sm leading-5 font-medium text-gray-500">
        @lang('livewire-tables::strings.per_page'): &nbsp;
    </div>
    <!-- Options -->
    <select
        wire:model="perPage"
        class="block pl-3 px-5 py-1.5 text-base leading-6 border-gray-300 rounded-md shadow-md text-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
    >
        @foreach ($perPageOptions as $option)
            <option>{{ $option }}</option>
        @endforeach
    </select>
</div>
