<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                 @if (is_numeric($refresh)) wire:poll.{{ $refresh }}.ms @elseif(is_string($refresh)) wire:poll="{{ $refresh }}" @endif
            >
                @include('livewire-tables::'.config('livewire-tables.theme').'.includes.offline')
                @include('livewire-tables::'.config('livewire-tables.theme').'.includes.options')

                <table class="min-w-full divide-y divide-gray-200">
                    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.thead')
                    <tbody>
                    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.loading')
                    @if($models->isEmpty())
                        @include('livewire-tables::'.config('livewire-tables.theme').'.includes.empty')
                    @else
                        @include('livewire-tables::'.config('livewire-tables.theme').'.includes.data')
                    @endif
                    </tbody>

                    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.tfoot')
                </table>


                @include('livewire-tables::'.config('livewire-tables.theme').'.includes.pagination')
            </div>
        </div>
    </div>
</div>
