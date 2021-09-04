


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ config('app.env') == 'local' ? asset('css/app.css') : asset(mix('css/app.css'), true) }}" rel="stylesheet">
    <link rel="icon" href="{{ local_images('favicon.png') }}">
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
    <link href="{{ config('app.env') == 'local' ? asset('css/home.css') : asset(mix('css/home.css'), true) }}" rel="stylesheet"  type="text/css">
    <title>500 Server Error - Eric Heng</title>
    @livewireStyles
</head>
<body class="bg-gray-850">
    <div class="h-screen w-screen bg-gray-100 flex items-center">
        <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
               <div class="max-w-md">
                  <div class="text-5xl font-dark font-bold">500</div>
                <p
                  class="text-2xl md:text-3xl font-light leading-normal"
                >Sorry our servers encountered an isssue. </p>
              <p class="mb-8">But dont worry, you can find plenty of other things on our homepage.</p>
              
                <div class="px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue bg-blue-600 active:bg-blue-600 hover:bg-blue-700">
                    <a href="/">
                        Back To Homepage
                    </a>
                </div>
        </div>
          <div class="max-w-lg">
            @php
                $random = rand(1,2);
            @endphp
            <img src="{{ local_images('404_'. $random.'.png') }}" src="#" class="max-h-96 md:max-h-128">
        </div>
      </div>
    </div>
</body>
</html>