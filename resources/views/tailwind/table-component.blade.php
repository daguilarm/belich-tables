<div class="flex flex-col">

    <!-- Include the table loading view -->
    @includeWhen($showLoading, BelichTables::include('sections.loading'))

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
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
                <!-- Include the table offline message -->
                @includeWhen($showOffline, BelichTables::include('sections.offline'))

                <!-- Load all the options: search, filters, perPage, export, new resource... -->
                @include(BelichTables::include('sections.options'))

                <div class="bg-gray-50 text-gray-500 border border-gray-200 rounded-t-lg rounded-b-lg">
                    <table class="table min-w-full leading-normal mt-1">

                        <!-- Include the table head -->
                        @includeWhen($showTableHead, BelichTables::include('sections.thead'))

                        <!-- Include the table data -->
                        <tbody>
                            @if($models->isEmpty())
                                @include(BelichTables::include('sections.empty'))
                            @else
                                @include(BelichTables::include('sections.data'))
                            @endif
                        </tbody>

                        <!-- Include the table foot -->
                        @includeWhen($showTableFooter, BelichTables::include('sections.tfoot'))
                    </table>

                    <!-- Include the pagination -->
                    @if($showPagination)
                        {{ $models->links(BelichTables::include('sections.pagination')) }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Css classes -->
<style>
    .pulse-vertical-align{top:30%}.pulse{width:80px;height:80px;position:fixed;left:50%;margin-left:-50px;top:50%;margin-top:-50px;}.double-bounce1,.double-bounce2{width:100%;height:100%;border-radius:50%;background-color:{{ belichConfig('belich.tables.loading.color', 'belich-tables.loadingColor') }};opacity:.6;position:absolute;top:0;left:0;-webkit-animation:sk-bounce 2s infinite ease-in-out;animation:sk-bounce 2s infinite ease-in-out}.double-bounce2{-webkit-animation-delay:-1s;animation-delay:-1s}@-webkit-keyframes sk-bounce{0%,100%{-webkit-transform:scale(0)}50%{-webkit-transform:scale(1)}}@keyframes sk-bounce{0%,100%{transform:scale(0);-webkit-transform:scale(0)}50%{transform:scale(1);-webkit-transform:scale(1)}}
    [x-cloak]{display:none;}
    /* Css if needed */
    @stack('belich-tables-css')
</style>

<!-- Javascript if needed -->
<script>
    @stack('belich-tables-javascript')
</script>
