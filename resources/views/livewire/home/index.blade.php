<style>
    html {
        scroll-snap-type: y proximity;
    }

    section {
        flex-basis: 50%;
        scroll-snap-align: start;
    }

    .title {
        font-family: 'IBM Plex Sans Thai', sans-serif;
    }

    .zigzag {
        background: 
        linear-gradient(135deg, black 25%, transparent 25%) -50px 0,
        linear-gradient(225deg, black 25%, transparent 25%) -50px 0,
        linear-gradient(315deg, black 25%, transparent 25%),
        linear-gradient(45deg, black 25%, transparent 25%);	
        background-size: 2em 2em;
        background-color: #232323;
    }

    .gradientShade {
        background: linear-gradient(-60deg, #000000, #232526, #414345, #232526, #000000);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

</style>

<div class="h-full">
    <section class="flex justify-center items-center h-screen gradientShade">
        <img src="{{ asset('storage/images/duck.png')}}" style="height: 150px;"/>
        <h1 class="text-white text-8xl title">
            ERIC HENG
        </h1>
    </section>
    <section class="flex flex-col justify-center items-start px-40 pt-5 bg-gray-800">
        <div class="text-white">
            <h2 class="flex justify-center font-bold text-2xl">Backend Developer</h2>
            <p class="text-xl px-80 pt-2">
                Ready for new challenges and finding new ways to level up. 
                I enjoy working in a team environment where teamwork and communication skills is key. 
                Been a programmer since 2014 which is about {{ $years }} years.
            </p>
        </div>
        <x-timeline.main />
    </section>
</div>