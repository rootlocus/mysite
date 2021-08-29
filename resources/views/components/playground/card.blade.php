<div class="{{$style}}">
    <div class="">
        <a href="{{$link}}">
            <img src="{{ local_images($image) }}" src="#" class="object-scale-down h-20 w-full">
        </a>
    </div>
    <div class="border-t-2 border-gray-400 p-2 text-gray-400">
        <a href="{{$link}}" class="flex justify-center content text-xl font-semibold"><span class="text-center">{{ $title }}</span></a>
        <p class="text-center">{{ $description }}</p>
    </div>
</div>
