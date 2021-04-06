<div
    class="{{ $this->getOption('tailwind.container') ? 'container mx-auto sm:px-4 max-w-full mx-auto sm:px-4' : '' }}"
    @if (is_numeric($refresh))
        wire:poll.{{ $refresh }}.ms
    @elseif(is_string($refresh))
        wire:poll="{{ $refresh }}"
    @endif
>
    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.offline')
    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.options')

    @if ($this->getOption('tailwind.responsive'))
        <div class="block w-full overflow-auto scrolling-touch">
    @endif
        <table class="min-w-full divide-y divide-gray-200">
            @include('livewire-tables::'.config('livewire-tables.theme').'.includes.thead')

            @include('livewire-tables::'.config('livewire-tables.theme').'.includes.loading')
                @if($models->isEmpty())
                    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.empty')
                @else
                    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.data')
                @endif
            </tbody>

            @include('livewire-tables::'.config('livewire-tables.theme').'.includes.tfoot')
        </table>
    @if ($this->getOption('tailwind.responsive'))
        </div><!--table-responsive-->
    @endif

    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.pagination')
</div>
