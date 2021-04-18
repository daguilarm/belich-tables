<!-- Table rows -->
@foreach($models as $model)
    <tr
        class="bg-white border-b border-gray-150"
    >
        <!-- Table checkbox -->
        @includeWhen($checkboxEnable && !isset($headerTitle), 'livewire-tables::'.config('livewire-tables.theme').'.includes.checkboxes.checkbox')

        <!-- Table columns -->
        @foreach($columns as $column)
            @if ($column->isVisible())
                <td
                    class="{{ $column->show }} px-6 py-3 whitespace-nowrap text-sm text-gray-500"
                >
                    <!-- Renderable column -->
                    @if ($column->isRenderable())
                        {!! $column->renderCallback($model) !!}

                    <!-- Formated column -->
                    @elseif ($column->isFormatted())
                        @if ($column->asHtml())
                            {!! $column->formatted(data_get($model, $column->getAttribute())) !!}
                        @else
                            {{ $column->formatted(data_get($model, $column->getAttribute())) }}
                        @endif

                    <!-- Regular column -->
                    @else
                        @if ($column->asHtml())
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
