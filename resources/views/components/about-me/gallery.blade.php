<div class="mx-auto max-w-2xl">
    {{-- <h2 class="text-4xl text-center tracking-wide font-extrabold font-serif leading-loose mb-2">Slideshow Gallery</h2> --}}
    <div class="shadow-2xl relative">
        <!-- large image on slides -->
        <div class="mySlides hidden">
            <div class="w-full object-cover"></div>
            <img src="{{ local_images('eric_food.png') }}" src="#" alt="eric02" class="max-h-96 md:max-h-128">
        </div>
        <div class="mySlides hidden">
            <div class="w-full object-cover">
                <img src="{{ local_images('monk.png') }}" src="#" alt="monk" class="max-h-96 md:max-h-128">
            </div>
        </div>

        <!-- butttons -->
        <a class="absolute left-0 inset-y-0 flex items-center -mt-32 px-4 text-white hover:text-gray-800 cursor-pointer text-3xl font-extrabold" onclick="plusSlides(-1)">❮</a>
        <a class="absolute right-0 inset-y-0 flex items-center -mt-32 px-4 text-white hover:text-gray-800 cursor-pointer text-3xl font-extrabold" onclick="plusSlides(1)">❯</a>

        <!-- smaller images under description -->
        <div class="flex">
            <div>
                <img src="{{ local_images('eric_food.png') }}" src="#" onclick="currentSlide(1)" class="description h-24 opacity-50 hover:opacity-100 cursor-pointer" alt="Globe" onclick="currentSlide(3)">
            </div>
            <div>
                <img src="{{ local_images('monk.png') }}" src="#" onclick="currentSlide(2)" class="description h-24 opacity-50 hover:opacity-100 cursor-pointer" alt="Globe" onclick="currentSlide(3)">
            </div>
        </div>
    </div>
    </div>
  
<script>
    //JS to switch slides and replace text in bar//
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("description");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" opacity-100", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " opacity-100";
    }
</script>