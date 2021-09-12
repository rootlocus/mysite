<!DOCTYPE html>
<html>
  <inertia-head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="icon" href="{{ local_images('favicon.png') }}">
    <link href="{{ config('app.env') == 'local' ? mix('/css/app.css') : asset(mix('/css/app.css')) }}" rel="stylesheet" />
    <script src="{{ config('app.env') == 'local' ? mix('/js/app.js') : asset(mix('/js/app.js')) }}" defer></script>
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@600&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href="{{ config('app.env') == 'local' ? asset('/css/home.css') : asset(mix('/css/home.css')) }}" rel="stylesheet"  type="text/css">
    <title>Eric Heng</title>
    @routes
  </inertia-head>
  <body class="bg-black">
    <x-nav/>
    <div>
      @inertia
    </div>
  </body>
</html>