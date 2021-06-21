{{-- Table rows --}}
@foreach($models as $model)
    <tr
        class="bg-white border-b border-gray-150"
        id="row_id_{{ $model->id }}"
        dusk="row-id-{{ $model->id }}"
    >
        {{-- Table checkbox --}}
        @includeWhen(
            data_get($tableOptions, 'checkboxes.show') && !isset($headerTitle),
            BelichTables::include('sections.checkboxes.checkbox')
        )

        {{-- Table columns --}}
        @foreach($columns as $column)
            @if ($column->isVisible())
                <td
                    class="{{ $column->getVisibility() }} px-6 py-3 break-words text-sm text-gray-500"
                    dusk="column-{{ $column->getAttribute() }}-{{ $model->id }}"
                >
                    {{-- Render column as Boolean --}}
                    @if ($column->isBoolean())
                        {{-- Render green --}}
                        @if ($column->resolveColumn($column, $model) === true)
                            <div class="h-4 w-4 rounded-full bg-green-400" dusk="boolean-on-{{ $model->id }}"></div>
                        {{-- Render gray --}}
                        @else
                            <div class="h-4 w-4 rounded-full bg-gray-200" dusk="boolean-off-{{ $model->id }}"></div>
                        @endif
                    {{-- Render column as HTML --}}
                    @elseif ($column->isHtml())
                        {!! $column->resolveColumn($column, $model) !!}

                    {{-- Render column --}}
                    @else
                        {{ $column->resolveColumn($column, $model) }}
                    @endif
                </td>
            @endif
        @endforeach
    </tr>
@endforeach
