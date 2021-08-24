<div class="my-10 flex justify-between items-center w-full {{$direction}}" :class="{}">
    <div class="order-1 w-5/12"></div>
    <div class="z-20 flex items-center order-1 bg-green-500 shadow-xl rounded-lg p-1">
        <h1 class="mx-auto font-semibold text-lg text-white">{{ $year }}</h1>
    </div>
    <div class="order-1 bg-indigo-800 rounded-lg shadow-xl w-5/12 px-6 py-4">
        <h3 class="mb-1 font-bold text-white text-xl hover:underline hover:text-green-500"><a href="{{$titleLink}}" target="_blank">{{ $title }}</a></h3>
        <p class="text-sm leading-snug tracking-wide text-white text-opacity-100 underline">
            <b>Tools:</b> {{ $tools }}
        </p>
        <ul class="list-disc text-sm leading-snug tracking-wide text-white text-opacity-100">
            {{ $slot }}
        </ul>
    </div>
</div>