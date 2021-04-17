{{-- If is inside a tab container (historical) not showing... --}}
<div
    x-data="{ isOpenExport: false }"
    class="hidden md:block"
>
    <div
        class="relative text-left"
        @click.away="isOpenExport = false"
    >
        <button type="button"
            x-on:click="isOpenExport = !isOpenExport"
            class="inline-flex ml-2 mt-3 items-center p-2 shadow-lg rounded-lg bg-white hover:bg-green-400 text-green-500 hover:text-white focus:outline-none"
            id="table_export_button"
            dusk="table-export-button"
        >
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
  {{-- Options --}}
    <div
        x-show="isOpenExport"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="origin-top-right absolute right-0 w-40 z-50"
        dusk="table-export-container"
        x-cloak
    >
        <div class="mt-1 border-2 border-green-300 rounded-md shadow-lg">
            <div class="rounded-md bg-green-100 shadow-xs">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="table_export_button">
                    @foreach($exports as $export)
                        <a
                            href="#"
                            dusk="export-{{ $export }}-link"
                            wire:click.prevent="export('{{ $export }}')"
                            x-on:click="isOpenExport = false"
                            class="block px-4 py-2 text-sm leading-5 text-green-700 hover:bg-green-400 hover:text-white focus:outline-none focus:bg-green-100 focus:text-green-900"
                        >
                            {{ __('files.format_' . $export) }}  @svg('heroicon-o-download', ['class' => 'ml-1 h-4 float-right'])
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

