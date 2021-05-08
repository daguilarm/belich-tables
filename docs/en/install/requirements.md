# Requirements

This package need at least:

- `PHP ^8.0`
- `Laravel ^8.0`
- `Laravel Livewire ^2.0`

And you will need to add to your template or layout the next `css` and `javascript` libraries:

- `AlpineJS ^2.0`
- `TailwindCSS ^2.0`

It will also be necessary to add the styles that the *package* requires, to do that just add in the `<head></head>` the **Blade** directive: `@belichTablesCss`

For example:

```html 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Livewire styles -->
        <livewire:styles />

        <!-- Belich tables styles -->
        @belichTablesCss

        <!-- TailwindCSS styles -->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

        <!-- AlpineJS javascript -->
        <script src="//cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    </head>
    <body>

        <!-- Livewire scripts -->
        <livewire:scripts />
    </body>
</html>
```
Or you can compiling the dependencies using **Laravel mix**...
