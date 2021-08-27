<div class="h-full">
    {{-- Stop trying to control. --}}
    <section class="bg-gray-750 h-screen">
        <div class="h-screen flex flex-col justify-center items-center">
            <h1 class="title text-white text-4xl">
                Username: {{ $username }} <br>
                Total Games: {{ $totalGames }} <br>
                Total Playtime(days): {{ $totalPlaytime }}
            </h1>
            <div class="flex flex-row justify-center items-center content-start space-x-10 pt-4 w-full">
                <div class="relative mr-6">
                    <input wire:model="steamId" type="search" class="bg-purple-white shadow rounded border-0 p-3" placeholder="Steam Id (eg; 76561197972495328)" style="width: 500px;">
                    {{-- <input wire:model="age" type="search" class="bg-purple-white shadow rounded border-0 p-3" placeholder="Age" style="width: 100px;"> --}}
                    <button wire:click="retrieve" class="bg-blue-400 hover:bg-blue-dark text-white font-bold px-4 py-2 rounded">Calculate</button>
                    <button wire:click="resetData" class="bg-blue-400 hover:bg-blue-dark text-white font-bold px-4 py-2 rounded">Reset</button>
                </div>
            </div>
            <div class="text-white content pt-10">
                <h2 class="text-2xl font-bold">FAQ</h2>
                <ol class="list-decimal">
                    <li>
                        <h3 class="font-bold">How to get your steam id ?</h3>
                        <p>
                            <a href="https://www.thegamer.com/how-to-find-your-steam-id/" class="text-blue-700">https://www.thegamer.com/how-to-find-your-steam-id/</a>
                        </p>
                    </li>
                    <li>
                        <h3 class="font-bold">Why is there no data ?</h3>
                        <p>Either your steam id provided is invalid, or you have blocked any public view access to your stats.</p>
        
                    </li>
                </ol>
            </div>
        </div>
    </section>
</div>
