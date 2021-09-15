<div class="flex flex-row md:h-screen h-full bg-hobby-pattern">
    <div class="w-1/2 flex items-center justify-center" id="content-desktop">
        <x-about-me.gallery  
            :images="$images"
            :currentImage="$currentImage"
        />
    </div>
    <div class="md:w-1/2 flex flex-row">
        <div class="bg-gray-750 text-gray-400 rounded shadow-xl py-5 px-5 md:w-3/4 flex flex-col">
            <div class="md:h-1/8 pt-10 md:pt-0">
                <h1 class="text-4xl font-semibold leading-tight flex-1 title">About Me</h1>
            </div>
            <div class="md:h-1/2 flex flex-col md:mt-40 mt-4 text-white content">
                <div class="h-3/8 pb-4">
                    <h2 class="text-4xl text-left">ERIC, HENG KOK KUAN</h2>
                </div>
                <p>
                    I grew up in Kuala Lumpur, Malaysia in the bustling city since 1992. In my early years one of my passions was using photoshop 
                    and helping clubs and events make posters and banners. I didn't do many sports, but my highest achievements in any activity 
                    was just reaching Black Belt, (Dan 1) in Taekwondo in my high school years. Living in a family where your parents and siblings 
                    use computers a lot, I ended up doing the same. In 2013, I graduated from Sunway Monash University with a Bachelor's  
                    in Computer Science Degree.
                </p><br>
                <p>
                    In my early career I joined a workforce and picked up COBOL. 
                    It was not a particulary exciting job and it seemed that I was very limited in what I could do.
                    After many years, I eventually picked up Laravel for a web deveopment job and suddenly the possibilities opened up.
                    The community, documentation and the support Laravel gives is the best I've experienced so far and is frankly
                    what makes using Laravel so fun to use.
                </p><br>
                <p>
                    I've been programming for the last 7 years and I could say for the most 
                    of my years, the things I made on my freetime were kind of a play project. 
                    So this website I made is one of the first real project I have 
                    managed to crunch out and put out there in the real world. Huzzah!
                </p><br>
                <p class="flex flex-row items-center justify-center">*</p>
                <p>
                    So to drop it out there, I play a lot of video games. I've been there since Neopets playing flash games online, 
                    or backseating DOS games my older siblings use to play. Video games definitely has taught me many things 
                    whether it was preseverence, puzzle solving, looking for help online, and also making friends.
                </p><br>
                <p>
                    I also do magic. Something I picked up while watching a youtube video and going,
                    <i>"how did he do that ??" </i>. I wouldn't say I'm a professional, but normally I provide everyone some good valued entertainment.
                </p>
            </div>
        </div> 
    </div>
</div>