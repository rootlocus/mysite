<div class="h-full">
    {{-- Stop trying to control. --}}
    <section class="gradientShadeGray h-screen">
        <div class="h-screen flex flex-col justify-center items-center">
            <h1 class="title text-white text-4xl">
                Total Games: {{ $totalGames }} <br>
                Total Playtime(days): {{ $totalPlaytime }}
            </h1>
            <div class="flex flex-row justify-center items-center content-start space-x-10 pt-4 w-full">
                <div class="relative mr-6">
                    <input wire:model="steamId" type="search" class="bg-purple-white shadow rounded border-0 p-3" placeholder="Steam Id (eg; 76561197972495328)" style="width: 500px;">
                    <input wire:model="age" type="search" class="bg-purple-white shadow rounded border-0 p-3" placeholder="Age" style="width: 100px;">
                    <button wire:click="retrieve" class="bg-blue-400 hover:bg-blue-dark text-white font-bold px-4 py-2 rounded">Calculate</button>
                    <button wire:click="resetData" class="bg-blue-400 hover:bg-blue-dark text-white font-bold px-4 py-2 rounded">Reset</button>
                </div>
            </div>
            <a href="https://www.thegamer.com/how-to-find-your-steam-id/" class="content text-blue-500">How to get your steam id</a>
        </div>
    </section>
</div>
