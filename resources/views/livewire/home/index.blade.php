<div class="bg-black h-full">
    <div class="flex justify-center items-center h-screen">
        <img src="{{ asset('storage/images/duck.png')}}" style="height: 150px;"/>
        <h1 class="text-white font-bold text-8xl ">
            ERIC HENG
        </h1>

    </div>
    <div class="flex flex-col justify-center items-start  p-40">
        <div class="text-white">
            <h2 class="flex justify-center font-bold text-2xl">Backend Developer</h2>
            <p class="text-xl">
                Ready for new challenges and finding new ways to level up. 
                I enjoy working in a team environment where teamwork and communication skills are key. 
                Been a programmer since 2014 which is about {{ $years }} years.
            </p>
        </div>
        <x-timeline />
    </div>
</div>