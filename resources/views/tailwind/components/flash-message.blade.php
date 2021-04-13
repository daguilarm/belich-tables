<div>
    @if($shown)
        <div
            class="rounded-r-lg shadow-md {{ $styles['bg-color'] }} p-5 border-l-4 {{ $styles['border-color'] }} mb-3"
            x-data
            x-init="setTimeout(() => $wire.dismiss(), 15000)"
        >
            <div class="flex">
                @if ($styles['icon'] ?? false)
                    <div class="flex-shrink-0">
                        <p class="{{ $styles['icon-color'] }}">
                            {!! $styles['icon'] !!}
                        </p>
                    </div>
                @endif
                <div class="ml-3 text-lg leading-5 font-normal {{ $styles['text-color'] }}">
                    {!! $message['message'] !!}
                </div>
                @if ($message['dismissable'] ?? false)
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button class="inline-flex rounded-md p-1.5 {{ $styles['text-color'] }} focus:outline-none transition ease-in-out duration-150" wire:click="dismiss">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
