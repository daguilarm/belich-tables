<?php

return [
    'views' => [
        'container' => 'livewire-flash::livewire.flash-container',
        'overlay' => 'livewire-flash::livewire.flash-overlay',

        // The package [livewire-tables] overwrite this view... so you need to be carefull
        'message' => 'livewire-flash::livewire.flash-message',
    ],
    'styles' => [
        'info' => [
            'bg-color' => 'bg-blue-100',
            'border-color' => 'border-blue-400',
            'icon-color' => 'text-blue-400',
            'text-color' => 'text-blue-800',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>',
        ],
        'success' => [
            'bg-color' => 'bg-green-100',
            'border-color' => 'border-green-400',
            'icon-color' => 'text-green-400',
            'text-color' => 'text-green-800',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>',
        ],
        'warning' => [
            'bg-color' => 'bg-yellow-100',
            'border-color' => 'border-yellow-400',
            'icon-color' => 'text-yellow-400',
            'text-color' => 'text-yellow-800',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>',
        ],
        'error' => [
            'bg-color' => 'bg-red-100',
            'border-color' => 'border-red-400',
            'icon-color' => 'text-red-400',
            'text-color' => 'text-red-800',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>',
        ],
        'overlay' => [
            'overly-bg-color' => 'bg-gray-500',
            'overlay-bg-opacity' => 'opacity-75',

            'title-text-color' => 'text-gray-900',

            'body-text-color' => 'text-gray-500',

            'button-border-color' => 'border-transparent',
            'button-bg-color' => 'bg-indigo-600',
            'button-text-color' => 'text-white',

            'button-hover-bg-color' => 'hover:bg-indigo-700',
            'button-hover-text-color' => 'hover:text-white',
            'button-focus-ring-color' => 'focus:ring-indigo-500',

            'button-extra-classes' => '',

            'button-text' => 'Close',
        ],
    ],
];
