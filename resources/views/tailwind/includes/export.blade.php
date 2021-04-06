@if (count($exports))
    <div class="relative table-export">
        <button class=" inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1 btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('livewire-tables::strings.export')
        </button>

        <div class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded" aria-labelledby="dropdownMenuButton">
            @if (in_array('csv', $exports, true))
                <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" href="#" wire:click.prevent="export('csv')">CSV</a>
            @endif

            @if (in_array('xls', $exports, true))
                <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" href="#" wire:click.prevent="export('xls')">XLS</a>
            @endif

            @if (in_array('xlsx', $exports, true))
                <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" href="#" wire:click.prevent="export('xlsx')">XLSX</a>
            @endif

            @if (in_array('pdf', $exports, true))
                <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" href="#" wire:click.prevent="export('pdf')">PDF</a>
            @endif
        </div>
    </div><!--export-dropdown-->
@endif
