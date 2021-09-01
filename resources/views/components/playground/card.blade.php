<div class="{{$style}} p-4 text-gray-400 hover:opacity-80">
    <a href="{{$link}}">
        <div class="border-1 border-b-4 border-black flex flex-row space-x-4 items-center justify-center">
            <h3 class="text-2xl">{{ $title }}</h3>
        </div>

        <div class="flex md:flex-row flex-col space-x-4 pt-2" v-for="item in cart.items" :key="item.id">
            <div class="flex justify-center mb-2 md:mb-0">
                <img src="{{ local_images($image) }}" src="#" class="h-20 max-w-lg">
            </div>
            <div class="flex items-center">
                <p class="text-center">{{ $description }}</p>
            </div>
        </div>
    </a>

</div>