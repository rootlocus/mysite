<div class="h-full">
    <section class="gradientShade h-screen">
        <div class="h-full flex flex-col justify-center items-center">
            <div class="flex flex-row items-center">
                <img src="{{ asset('storage/images/duck.png')}}" style="height: 150px;"/>
                <h1 class="text-white text-8xl title">
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
                    <a href="https://www.instagram.com/erickokkuan/">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                </span>
            </div>
        </div>
    </section>
    <section class="flex flex-col justify-center items-start px-40 pt-5 bg-gray-800">
        <div class="text-white text-center ">
            <h2 class="font-bold text-2xl">Backend Developer</h2>
            <p class="text-xl px-80 pt-2">
                Ready for new challenges and finding new ways to level up. 
                I enjoy working in a team environment where teamwork and communication skills is key. 
                Been a programmer since 2014 which is about {{ $years }} years.
            </p>
        </div>
        <x-timeline.main/>
    </section>
    <section class="bg-gray-700 h-screen">
        <div class="h-full flex flex-col justify-center items-center">
        <div class="text-white text-center"> 
            <h2 class="font-bold text-2xl">Contact Me</h2>
            <p class="text-l py-2">
                Just drop a message if you want to reach out to me!
            </p>
        </div>

        <x-contact-me.form/>
    </section>

</div>  