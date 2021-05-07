<!DOCTYPE html>
<html lang="en-EN">
    <head>
        <title>Testing</title>
        <script src="https://tailwind-jit.beyondco.de/tailwind.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        @livewireStyles
    </head>
    <body>
        <section>
            @livewire('users-table')
        </section>

        {{-- Modals --}}
        @stack('modals')

        {{-- Javascript --}}
        @livewireScripts
    </body>
</html>
