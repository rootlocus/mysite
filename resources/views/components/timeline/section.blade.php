<div x-data="{isShow: false}">
    <div id="content-desktop" class="my-10 flex justify-between items-center w-full {{$direction}} pb-10">
        <div class="order-1 w-5/12"></div>
        <div class="order-1 bg-green-500 shadow-xl rounded-lg p-1 filter drop-shadow-lg">
            <h1 class="mx-auto font-semibold text-lg text-white content">{{ $year }}</h1>
        </div>
        <div class="order-1 bg-indigo-900 rounded-lg shadow-xl w-5/12 px-6 py-4 filter drop-shadow-lg hover:bg-indigo-800" @click="isShow = !isShow">
            <div class="flex flex-row">
                <img src="{{ $image }}" class="max-h-20"/>
                <h3 class="mb-1 font-bold text-white text-xl hover:underline hover:text-green-500 py-4 pl-2"><a href="{{$titleLink}}" target="_blank">{{ $title }}</a></h3>
            </div>
            <div x-show.transition.in.duration.500="isShow">
                <p class="text-sm leading-snug tracking-wide text-white text-opacity-100 py-2 font-mono">
                    <b class="text-l">Tools:</b> {{ $tools }}
                </p>
                <ul class="list-disc text-sm leading-snug tracking-wide text-white text-opacity-100 leading-relaxed">
                    {{ $slot }}
                </ul>
            </div>
        </div>
    </div>
    <div id="content-mobile" class="my-10 flex justify-between items-center w-full {{$direction}} pb-10">
        <div class="flex items-center order-1 bg-green-500 shadow-l rounded-lg filter drop-shadow-lg mb-2">
            <h1 class="mx-auto font-semibold text-lg text-white content">{{ $year }}</h1>
        </div>
        <div class="order-1 bg-indigo-900 rounded-lg shadow-l px-8 py-4 filter drop-shadow-lg" @click.prevent="isShow = !isShow">
            <div class="flex flex-row justify-center space-x-4">
                <img src="{{ $image }}" class="w-1/2 pr-4"/>
                <h3 class="mb-1 font-bold text-white text-xl hover:underline hover:text-green-500 w-1/2 text-center"> <a href="{{$titleLink}}" target="_blank">{{ $title }}</a></h3>
            </div>
            <div x-show.transition.in.duration.500="isShow">
                <p class="text-xs leading-snug tracking-wide text-white text-opacity-100 py-2 font-mono">
                    <b class="text-l">Tools:</b> {{ $tools }}
                </p>
                <ul class="list-disc text-xs leading-snug tracking-wide text-white text-opacity-100 leading-relaxed">
                    {{ $slot }}
                </ul>
            </div>
            <div class="flex justify-center">
                <span style="font-size: 1em; color: white;" class="animate-bounce">
                    <i class="fa fa-angle-down" aria-hidden="true" x-show="!isShow"></i>
                    <i class="fa fa-angle-up" aria-hidden="true" x-show="isShow"></i>
                </span>
            </div>
        </div>
    </div>
</div>