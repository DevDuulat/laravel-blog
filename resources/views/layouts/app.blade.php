<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="pt-20">
@include('components.header')

<div class="flex flex-col min-h-screen">
    <main class="flex-grow">
        @yield('content')
    </main>
</div>

@include('components.footer')

@livewireScripts
</body>
</html>
