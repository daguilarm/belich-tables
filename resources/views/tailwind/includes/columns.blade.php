<tr class="border-b border-gray-200">
    <!-- Table head checkbox -->
    @includeWhen($showCheckboxes && !isset($headerTitle), 'livewire-tables::'.config('livewire-tables.theme').'.includes.checkboxes.checkbox-header')

    <!-- All the columns -->
    @foreach($columns as $column)
        {{-- Set the column name --}}
        @php $columnName = Str::lower($column->getText()); @endphp
        @if ($column->isVisible())
            @if($column->isSortable())
                <!-- Sortable column -->
                <th
                    scope="col"
                    class="{{ $column->show }} px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                    id="column-{{ $columnName }}"
                    dusk="column_{{ $columnName }}"
                    wire:click="sort('{{ $column->getAttribute() }}')"
                >
                    <div class="flex justify-start items-center">

                        <!-- Column text -->
                        {{ $column->getText() }}

                        <!-- Default icon: --- -->
                        @if ($sortField !== $column->getAttribute())
                            <svg class="flex h-4 text-gray-300 ml-2" style="margin-top: 2px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"></path>
                            </svg>

                        <!-- ASC icon: heroicon-s-chevron-up -->
                        @elseif ($sortDirection === 'asc')
                            <svg class="flex h-4 text-gray-400 ml-2" style="margin-top: 2px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" />
                            </svg>

                        <!-- DESC icon: heroicon-s-chevron-down -->
                        @else
                            <svg class="flex h-4 text-gray-400 ml-2" style="margin-top: 2px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        @endif
                    </div>
                </th>
            @else
                <!-- Not sortable column -->
                <th
                    scope="col"
                    class="{{ $column->show }} px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    id="column-{{ $columnName }}"
                    dusk="column_{{ $columnName }}"
                >
                    <!-- Column text -->
                    {{ $column->getText() }}
                </th>
            @endif
        @endif
    @endforeach
</tr>
