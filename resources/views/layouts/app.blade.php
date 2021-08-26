<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ config('app.env') == 'local' ? asset('css/app.css') : secure_asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ config('app.env') == 'local' ? asset('storage/images/favicon.png') : secure_asset('storage/images/favicon.png')}}">
    {{-- Awesome icons --}}
    <script src="https://kit.fontawesome.com/a17b9c82a3.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/6808795aaa.js"></script>
    {{-- alpine --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@600&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href="{{ config('app.env') == 'local' ? asset('css/home.css') : secure_asset('css/home.css') }}" rel="stylesheet"  type="text/css">
    <title>Eric Heng - {{ $title ? $title : 'Web Developer, PC Gamer & Magic Enthusiast' }}</title>
    @livewireStyles
</head>
<body>
    {{ $slot }}
    @livewireScripts
</body>
</html>