<div id="belich-tables" dusk="belich_tables">

    <div class="flex flex-col">

        {{-- Include messages --}}
        @includeWhen(
            session()->has('message'),
            BelichTables::include('components.flash-message')
        )

        {{-- Include the table loading view --}}
        @includeWhen(
            $tableOptions->get('loading'),
            BelichTables::include('sections.loading')
        )

        <div class="py-2 align-middle inline-block sm:px-6 lg:px-8">
            <div
                class="border-b border-gray-200 sm:rounded-lg"
                {{-- Refresh the table  --}}
                @if ($tableOptions->get('refresh'))
                    @if ($tableOptions->get('refreshInSeconds'))
                        wire:poll.{{ $tableOptions->get('refreshInSeconds') * 1000 }}ms
                    @else
                        wire:poll
                    @endif
                @endif
            >
                {{-- Include the table offline message --}}
                @includeWhen(
                    $tableOptions->get('offline'),
                    BelichTables::include('sections.offline')
                )

                {{-- Load all the options: search, filters, perPage, export, new resource... --}}
                @include(BelichTables::include('sections.options'))

                <div class="bg-gray-50 text-gray-500 border border-gray-200 rounded-t-lg rounded-b-lg">
                    <table class="table-auto w-full mt-1">

                        {{-- Include the table head --}}
                        @includeWhen(
                            data_get($tableOptions, 'table.head'),
                            BelichTables::include('sections.thead')
                        )

                        {{-- Include the table data --}}
                        <tbody>
                            @if($models->isEmpty())
                                @include(BelichTables::include('sections.empty'))
                            @else
                                @include(BelichTables::include('sections.data'))
                            @endif
                        </tbody>

                        {{-- Include the table foot --}}
                        @includeWhen(
                            data_get($tableOptions, 'table.footer'),
                            BelichTables::include('sections.tfoot')
                        )
                    </table>

                    {{-- Include the pagination --}}
                    @if($tableOptions->get('pagination'))
                        {{ $models->links(BelichTables::include('sections.pagination')) }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Javascript if needed --}}
    <script>
        @stack('belich-tables-javascript')
    </script>

</div>
