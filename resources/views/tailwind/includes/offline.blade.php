@if ($offlineIndicator)
    <div wire:offline.class="block" wire:offline.class.remove="d-none" class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800 hidden">
        @lang('livewire-tables::strings.offline')
    </div>
@endif
