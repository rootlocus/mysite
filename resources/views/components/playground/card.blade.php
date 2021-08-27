<div class="{{$style}}">
    <a href="{{$link}}">
        <img src="{{ local_images($image) }}" src="#" class="h-1/2 mx-auto py-2">
    </a>
    <div class="h-1/2 border-t-2 border-gray-400 p-2 text-gray-400 ">
        <a href="{{$link}}" class="flex justify-center content text-xl font-semibold">{{ $title }}</a>
        <p class="text-center">{{ $description }}</p>
    </div>
</div>
