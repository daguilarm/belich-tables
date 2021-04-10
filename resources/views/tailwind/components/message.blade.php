@php
    $color = ($message === 'message.success') ? 'green' : 'red';
@endphp

@if (session()->has($message))
    {{-- Container --}}
    <div
        class="flex items-center mx-auto w-5/6 xl:w-1/2 rounded-lg shadow-md mb-4 border border-{{ $color }}-100 p-5 bg-{{ $color }}-50 text-{{ $color }}-600"
    >
        {{-- Icon --}}
        <div class="flex-shrink-0 mr-2">
            {{-- Heroicon name: solid/check-circle --}}
            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        </div>
        {{-- Message --}}
        <div>
            @if(is_array(session($message)))
                @foreach(session($message) as $item)
                    <div>{{ $item }}</div>
                @endforeach
            @else
                {{ session($message) }}
            @endif
        </div>
    </div>
@endif
