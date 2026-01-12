<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5174957124050822" crossorigin="anonymous"></script>
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
