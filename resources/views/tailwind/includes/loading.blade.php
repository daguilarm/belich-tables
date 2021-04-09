@if ($loadingIndicator)
    <div
        wire:loading
        class="pulse pulse-vertical-align"
    >
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
@endif
