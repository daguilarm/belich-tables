<!-- Table rows -->
@foreach($models as $model)
    <tr
        class="bg-white border-b border-gray-150"
    >
        <!-- Table checkbox -->
        @includeWhen($showCheckboxes && !isset($headerTitle), LivewireTables::include('includes.checkboxes.checkbox'))

        <!-- Table columns -->
        @foreach($columns as $column)
            @if ($column->isVisible())
                <td
                    class="{{ $column->show }} px-6 py-3 whitespace-nowrap text-sm text-gray-500"
                >
                    <!-- Render column as Boolean -->
                    @if ($column->boolean)
                        @if ($column->resolveColumn($column, $model) === true)
                            <div class="h-4 w-4 rounded-full bg-green-400"></div>
                        @else
                            <div class="h-4 w-4 rounded-full bg-gray-200"></div>
                        @endif
                    <!-- Render column as HTML -->
                    @elseif ($column->asHtml)
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
