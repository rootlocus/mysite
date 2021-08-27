<div class="mx-auto max-w-2xl">
    {{-- <h2 class="text-4xl text-center tracking-wide font-extrabold font-serif leading-loose mb-2">Slideshow Gallery</h2> --}}
    <div class="flex flex-col justify-center items-center shadow-2xl relative">
        <!-- large image on slides -->
          <div style="display: block;">
              <div class="w-full object-cover"></div>
              <div class="">
                <img src="{{ local_images($currentImage) }}" src="#" class="max-h-96 md:max-h-128">
              </div>
          </div>

        <!-- smaller images under description -->
        <div class="flex">
          @foreach ($images as $key => $image )
            <div>
              <img src="{{ local_images($image) }}" wire:click="swapImage( {{ json_encode($image) }} )" 
                class="description h-24 opacity-50 hover:opacity-100 cursor-pointer">
            </div>
          @endforeach
        </div>
    </div>
</div>