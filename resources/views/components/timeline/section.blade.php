<div id="content-desktop" class="my-10 flex justify-between items-center w-full {{$direction}} pb-10">
    <div class="order-1 w-5/12"></div>
    <div class="z-20 flex items-center order-1 bg-green-500 shadow-xl rounded-lg p-1 filter drop-shadow-lg">
        <h1 class="mx-auto font-semibold text-lg text-white content">{{ $year }}</h1>
    </div>
    <div class="order-1 bg-indigo-800 rounded-lg shadow-xl w-5/12 px-6 py-4 filter drop-shadow-lg transform hover:scale-110">
        <h3 class="mb-1 font-bold text-white text-xl hover:underline hover:text-green-500"><a href="{{$titleLink}}" target="_blank">{{ $title }}</a></h3>
        <p class="text-sm leading-snug tracking-wide text-white text-opacity-100 py-2 font-mono">
            <b class="text-l">Tools:</b> {{ $tools }}
        </p>
        <ul class="list-disc text-sm leading-snug tracking-wide text-white text-opacity-100 leading-relaxed">
            {{ $slot }}
        </ul>
    </div>
</div>
<div id="content-mobile" class="my-10 flex justify-between items-center w-full {{$direction}} pb-10">
    <div class="flex items-center order-1 bg-green-500 shadow-l rounded-lg filter drop-shadow-lg mb-2">
        <h1 class="mx-auto font-semibold text-lg text-white content">{{ $year }}</h1>
    </div>
    <div class="order-1 bg-indigo-800 rounded-lg shadow-l px-8 py-4 filter drop-shadow-lg">
        <h3 class="mb-1 font-bold text-white text-xl hover:underline hover:text-green-500 underline"><a href="{{$titleLink}}" target="_blank">{{ $title }}</a></h3>
        <p class="text-xs leading-snug tracking-wide text-white text-opacity-100 py-2 font-mono">
            <b class="text-l">Tools:</b> {{ $tools }}
        </p>
        <ul class="list-disc text-xs leading-snug tracking-wide text-white text-opacity-100 leading-relaxed">
            {{ $slot }}
        </ul>
    </div>
</div>