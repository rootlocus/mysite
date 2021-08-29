<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="icon" href="{{ local_images('favicon.png') }}">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@600&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href="{{ config('app.env') == 'local' ? asset('css/home.css') : secure_asset('css/home.css') }}" rel="stylesheet"  type="text/css">
    <title>Eric Heng</title>
    @routes
  </head>
  <body class="">
    <div class="text-gray-400 space-x-4 content text-xl font-semibold flex flex-row justify-center items-center fixed filter drop-shadow-md h-10 p-4 pt-8">
      <a class="active" href="/">home</a>
      <a href="/about-me">about</a>
      <a href="/playground">playground</a>
    </div>
    <div>
      @inertia
    </div>
  </body>
</html>