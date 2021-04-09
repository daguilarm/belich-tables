<div class="flex flex-col">

    {{-- Loading --}}
    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.loading')

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div
                class="overflow-hidden border-b border-gray-200 sm:rounded-lg"
                {{-- Refresh table --}}
                @if (is_numeric($refresh)) wire:poll.{{ $refresh }}.ms @elseif(is_string($refresh)) wire:poll="{{ $refresh }}" @endif
            >
                {{-- Offline message --}}
                @include('livewire-tables::'.config('livewire-tables.theme').'.includes.offline')

                {{-- Options: search, filters, perPage,... --}}
                @include('livewire-tables::'.config('livewire-tables.theme').'.includes.options')

                <table class="min-w-full divide-y divide-gray-200">

                    {{-- Table head --}}
                    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.thead')

                    {{-- Table data --}}
                    <tbody>
                        @if($models->isEmpty())
                            @include('livewire-tables::'.config('livewire-tables.theme').'.includes.empty')
                        @else
                            @include('livewire-tables::'.config('livewire-tables.theme').'.includes.data')
                        @endif
                    </tbody>

                    {{-- Table foot --}}
                    @include('livewire-tables::'.config('livewire-tables.theme').'.includes.tfoot')
                </table>

                {{-- Pagination --}}
                @include('livewire-tables::'.config('livewire-tables.theme').'.includes.pagination')
            </div>
        </div>
    </div>
</div>

{{-- Set loading color --}}
@php
    $pulseColor = 'rgba(147, 197, 253, 1)';
@endphp

{{-- Loading css --}}
<style>
    .pulse-vertical-align{top:30%}.pulse{width:80px;height:80px;position:fixed;left:50%;margin-left:-50px;top:50%;margin-top:-50px;}.double-bounce1,.double-bounce2{width:100%;height:100%;border-radius:50%;background-color:{{ $pulseColor }};opacity:.6;position:absolute;top:0;left:0;-webkit-animation:sk-bounce 2s infinite ease-in-out;animation:sk-bounce 2s infinite ease-in-out}.double-bounce2{-webkit-animation-delay:-1s;animation-delay:-1s}@-webkit-keyframes sk-bounce{0%,100%{-webkit-transform:scale(0)}50%{-webkit-transform:scale(1)}}@keyframes sk-bounce{0%,100%{transform:scale(0);-webkit-transform:scale(0)}50%{transform:scale(1);-webkit-transform:scale(1)}}
</style>
