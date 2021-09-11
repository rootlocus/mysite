<div class="h-full">
    <section class="gradientShadeGray h-screen">
        <div class="h-full flex flex-col justify-center items-center">
            <div class="flex flex-col space-y-2 items-center">
                <img src="{{ local_images('myicon.svg') }}" style="height: 120px;"/>
                <h1 class="text-white md:text-8xl text-6xl font-bold title border-t-2 border-b-4 border-r-4 border-l-2 md:border-t-4 md:border-b-8 md:border-r-8 md:border-l-4 border-solid filter drop-shadow-lg">
                    ERIC HENG
                </h1>
            </div>
            <div class="mt-10 flex flex-row text-white space-x-4">
                <span style="font-size: 1em; color: white;">
                    <a href="mailto: erickokkuan@gmail.com" target="_blank">
                        <i class="far fa-envelope fa-2x"></i>
                    </a>
                </span>
                <span style="font-size: 1em; color: white;">
                    <a href="https://www.linkedin.com/in/kok-kuan-heng-00369063/" target="_blank">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                </span>
                <span style="font-size: 1em; color: white;">
                    <a href="https://github.com/rootlocus/" target="_blank">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                </span>
                <span style="font-size: 1em; color: white;">
                    <a href="https://www.instagram.com/erickokkuan/" target="_blank">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                </span>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-16 flex flex-row justify-center items-center text-white">
                <span style="font-size: 1em; color: white;" class="animate-bounce h-10 ">
                    <a href="#timeline" class="scrollLink">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>
                </span>
            </div>
        </div>
    </section>
    <section class="gradientShadeWinter flex flex-col justify-center items-start md:px-40 py-5" id="timeline">
        <div class="text-white text-center ">
            <h2 class="font-bold text-2xl">Backend Developer</h2>
            <p class="text-l md:text-xl md:px-80 pt-2 px-8">
                Ready for new challenges and finding new ways to level up. 
                I enjoy working in a team environment where teamwork and communication skills is key. 
                Been a programmer since 2014 which is about {{ $years }} years.
            </p>
        </div>
        <x-timeline.main/>
    </section>
    <section class="gradientShadeWhale h-screen">
        <div class="h-full flex flex-col justify-center items-center">
        <div class="text-indigo-800 text-center"> 
            <h2 class="font-bold text-2xl">Contact Me</h2>
            <p class="text-l py-2">
                Just drop a message if you want to reach out to me!
            </p>
        </div>
        <x-contact-me.form :isDisabled="$isDisabled"/>
    </section>
</div>  