{{-- Offline warning --}}
<div
    wire:offline.class="block"
    wire:offline.class.remove="hidden"
    class="alert alert-danger hidden"
>
    {{-- Offline warning message --}}
    @lang('livewire-tables::strings.offline')
</div>
