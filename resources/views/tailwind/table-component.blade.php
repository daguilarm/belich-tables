<div id="belich-tables" dusk="belich_tables">

    <div class="flex flex-col">

        {{-- Include messages --}}
        @includeWhen(session()->has('message'), BelichTables::include('components.flash-message'))

        {{-- Include the table loading view --}}
        @include(BelichTables::include('sections.loading'))

        <div class="min-w-full min-h-screen py-2 align-middle inline-block sm:px-6 lg:px-8">
            <div
                class="border-b border-gray-200 sm:rounded-lg"
                {{-- Refresh the table  --}}
                @if ($refresh)
                    @if ($refreshInSeconds)
                        wire:poll.{{ $refreshInSeconds * 1000 }}ms
                    @else
                        wire:poll
                    @endif
                @endif
            >
                {{-- Include the table offline message --}}
                @includeWhen($showOffline, BelichTables::include('sections.offline'))

                {{-- Load all the options: search, filters, perPage, export, new resource... --}}
                @include(BelichTables::include('sections.options'))

                <div class="bg-gray-50 text-gray-500 border border-gray-200 rounded-t-lg rounded-b-lg">
                    <table class="table min-w-full leading-normal mt-1">

                        {{-- Include the table head --}}
                        @includeWhen($showTableHead, BelichTables::include('sections.thead'))

                        {{-- Include the table data --}}
                        <tbody>
                            @if($models->isEmpty())
                                @include(BelichTables::include('sections.empty'))
                            @else
                                @include(BelichTables::include('sections.data'))
                            @endif
                        </tbody>

                        {{-- Include the table foot --}}
                        @includeWhen($showTableFooter, BelichTables::include('sections.tfoot'))
                    </table>

                    {{-- Include the pagination --}}
                    @if($showPagination)
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
