@foreach($models as $model)
    <tr
        class="bg-white border-b border-gray-150"
        id="{{ $this->setTableRowId($model) }}"
        {{-- Load all the attributes --}}
        @foreach ($this->setTableRowAttributes($model) as $key => $value)
            {{ $key }}="{{ $value }}"
        @endforeach
        @if ($this->getTableRowUrl($model))
            onclick="window.location='{{ $this->getTableRowUrl($model) }}';"
            class="cursor-pointer"
        @endif
    >
        {{-- Table checkbox --}}
        @includeWhen($checkboxEnable && !isset($headerTitle), 'livewire-tables::'.config('livewire-tables.theme').'.includes.checkboxes.checkbox')

        {{-- Create all the columns --}}
        @foreach($columns as $column)
            @if ($column->isVisible())
                <td
                    class="px-6 py-3 whitespace-nowrap text-sm text-gray-500"
                    id="{{ $this->setTableDataId($column->getAttribute(), data_get($model, $column->getAttribute())) }}"
                    @foreach ($this->setTableDataAttributes($column->getAttribute(), data_get($model, $column->getAttribute())) as $key => $value)
                    {{ $key }}="{{ $value }}"
                    @endforeach
                >
                    {{-- Formated column --}}
                    @if ($column->isFormatted())
                        @if ($column->isRaw())
                            {!! $column->formatted($model, $column) !!}
                        @else
                            {{ $column->formatted($model, $column) }}
                        @endif

                    {{-- Regular column --}}
                    @else
                        @if ($column->isRaw())
                            {!! data_get($model, $column->getAttribute()) !!}
                        @else
                            {{ data_get($model, $column->getAttribute()) }}
                        @endif
                    @endif
                </td>
            @endif
        @endforeach
    </tr>
@endforeach
