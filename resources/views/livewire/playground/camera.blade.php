<div class="min-h-screen bg-gray-850 pt-20">
    <div class="md:m-40 m-20 md:mx-96 md:flex md:flex-col space-y-4 justify-center items-center text-white">
        <div class="title text-4xl text-center">Teachable Machine Image Model</div>
        <div><a class="text-blue-700" href="https://teachablemachine.withgoogle.com/" target="_blank">https://teachablemachine.withgoogle.com/</a></div>
        <div class="flex space-x-2">
            @if(!$isLive)
            <button class="bg-gray-500 rounded p-1" type="button" onclick="init()" wire:click="onCamera">Start</button>
            @endif
        </div>
        <div id="special">
        </div>
        @if(!$isLive)
            <div class="bg-black md:h-112 md:w-112 text-center pt-10">
                <span>Click Start To Load Camera</span>
            </div>
        @else
            <div id="webcam-container">
            </div>
        @endif
        <div class="flex">
            I detect something...
            <div id="label-container">
            </div>
        </div>
        <div>
            <p>
                You may draw few shapes for the machine to identify. 
                So far, I've only included 3 shapes and one special shape which is drawn by hand.
                You may require to put the camera up to the white paper directly onto the image for it to detect properly.
                Here are the sample shapes I'ved used.
            </p>
        </div>
        <div class="flex space-x-4">
            <div>
                Circle
                <img src="{{ local_images('circle.png') }}" class="max-h-20"/>
            </div>
            <div>
                Triangle
                <img src="{{ local_images('triangle.png') }}" class="max-h-20"/>
            </div>
            <div>
                Square
                <img src="{{ local_images('square.png') }}" class="max-h-20"/>
            </div>
            <div>
                SPECIAL
                <img src="{{ local_images('star.png') }}" class="max-h-20"/>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // More API functions here:
    // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

    // the link to your model provided by Teachable Machine export panel
    const URL = "https://teachablemachine.withgoogle.com/models/7tLVDzKWx/";

    let model, webcam, labelContainer, maxPredictions;
    let isSpecial = false;

    // Load the image model and setup the webcam
    async function init() {
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";
        // let isIos = false; 

        // if (window.navigator.userAgent.indexOf('iPhone') > -1 || window.navigator.userAgent.indexOf('iPad') > -1) {
        //     isIos = true;
        // }
        // load the model and metadata
        // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
        // or files from your local hard drive
        // Note: the pose library adds "tmImage" object to your window (window.tmImage)
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();

        // Convenience function to setup a webcam
        const flip = false; // whether to flip the webcam
        webcam = new tmImage.Webcam(400, 400, flip); // width, height, flip
        await webcam.setup({ facingMode: "environment" }); // request access to the webcam
        await webcam.play();
        window.requestAnimationFrame(loop);

        // if (isIos) {
        //     document.getElementById('webcam-container').appendChild(webcam.webcam); // webcam object needs to be added in any case to make this work on iOS
        //     // grab video-object in any way you want and set the attributes
        //     const webCamVideo = document.getElementsByTagName('video')[0];
        //     webCamVideo.setAttribute("playsinline", true); // written with "setAttribute" bc. iOS buggs otherwise
        //     webCamVideo.muted = "true";
        //     webCamVideo.style.width = width + 'px';
        //     webCamVideo.style.height = height + 'px';
        // } else {
            // append elements to the DOM
            document.getElementById("webcam-container").appendChild(webcam.canvas);
        // }

        labelContainer = document.getElementById("label-container");
        for (let i = 0; i < maxPredictions; i++) { // and class labels
            labelContainer.appendChild(document.createElement("div"));
        }
    }

    async function loop() {
        webcam.update(); // update the webcam frame
        await predict();
        window.requestAnimationFrame(loop);
    }

    function stopCamera() {
        webcam.stop();
    }
    // run the webcam image through the image model
    async function predict() {
        // predict can take in an image, video or canvas html element
        // if(isIos) {
        //     const prediction = await model.predict(webcam.webcam);
        // } else {
            const prediction = await model.predict(webcam.canvas);
        // }

        let maxVal = null;
        let maxClass = null;
        for (let i = 0; i < maxPredictions; i++) {
            if (maxClass == null) {
                maxClass = prediction[i].className;
                maxVal = prediction[i].probability.toFixed(2);
            } 

            if (maxVal < prediction[i].probability) {
                maxClass = prediction[i].className;
                maxVal = prediction[i].probability.toFixed(2);
            }
            // const classPrediction = prediction[i].className + ": " + prediction[i].probability.toFixed(2);
            // labelContainer.childNodes[i].innerHTML = classPrediction;
        }
        labelContainer.innerHTML = maxClass;

        if (labelContainer.innerHTML == 'Special' && isSpecial === false) {
            document.getElementById("special").innerHTML = 'Get ready for a surprise !';
            getRickRolled();
            isSpecial = true;
        }
    }

    function getRickRolled()
    {
        console.log("ENTER roll");
        setTimeout(function() {
            document.getElementById("special").innerHTML = '<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }, 2000, this);
    }
</script>