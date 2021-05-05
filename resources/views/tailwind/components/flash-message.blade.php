@php
    $type = session('message')[0];

    // Default values
    $color = 'blue';
    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>';

    if($type === 'success') {
        $color = 'green';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>';
    }

    if($type === 'danger') {
        $color = 'red';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>';
    }

    if($type === 'warning') {
        $color = 'yellow';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>';
    }
@endphp

<div id="{{ session('message')[2] }}">
    <div
        class="shadow-md bg-{{ $color }}-100 p-5 border-l-4 border-{{ $color }}-400 m-4 mt-6"
        x-data="{
            visible: true,
            dismissMessage(id) {
                return document.getElementById(id).innerHTML = '';
            },
        }"
        x-show="visible"
        x-init="setTimeout(() => dismissMessage('{{ session('message')[2] }}'), 10000)"
    >
        <div class="flex">
            <div class="flex-shrink-0">
                <p class="text-{{ $color }}-400">
                    {!! $icon !!}
                </p>
            </div>
            <div class="ml-3 text-lg leading-5 font-normal text-{{ $color }}-800">
                {!! session('message')[1] !!}
            </div>
        </div>
    </div>
</div>
