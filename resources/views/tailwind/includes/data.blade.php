<!-- Table rows -->
@foreach($models as $model)
    <tr
        class="bg-white border-b border-gray-150"
    >
        <!-- Table checkbox -->
        @includeWhen($showCheckboxes && !isset($headerTitle), 'livewire-tables::'.config('livewire-tables.theme').'.includes.checkboxes.checkbox')

        <!-- Table columns -->
        @foreach($columns as $column)
            @if ($column->isVisible())
                <td
                    class="{{ $column->show }} px-6 py-3 whitespace-nowrap text-sm text-gray-500"
                >
                    <!-- Render column as HTML -->
                    @if ($column->asHtml())
                        {!! $column->resolveColumn($column, $model) !!}

                    <!-- Render column -->
                    @else
                        {{ $column->resolveColumn($column, $model) }}
                    @endif
                </td>
            @endif
        @endforeach
    </tr>
@endforeach
