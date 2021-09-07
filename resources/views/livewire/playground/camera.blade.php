<div class="min-h-screen bg-gray-850 pt-20">
    <div class="md:m-40 m-20 md:mx-96 md:flex md:flex-col space-y-12 justify-center items-center text-white">
        <div>Teachable Machine Image Model</div>
        <button type="button" onclick="init()">Start</button>
        <button type="button" onclick="stopCamera()">Stop</button>
        <div id="webcam-container"></div>
        <div id="label-container"></div>
    </div>
</div>
<script type="text/javascript">
    // More API functions here:
    // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

    // the link to your model provided by Teachable Machine export panel
    const URL = "https://teachablemachine.withgoogle.com/models/GZwdSDE72/";

    let model, webcam, labelContainer, maxPredictions;

    // Load the image model and setup the webcam
    async function init() {
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";

        // load the model and metadata
        // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
        // or files from your local hard drive
        // Note: the pose library adds "tmImage" object to your window (window.tmImage)
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();

        // Convenience function to setup a webcam
        const flip = true; // whether to flip the webcam
        webcam = new tmImage.Webcam(200, 200, flip); // width, height, flip
        await webcam.setup(); // request access to the webcam
        await webcam.play();
        window.requestAnimationFrame(loop);

        // append elements to the DOM
        document.getElementById("webcam-container").appendChild(webcam.canvas);
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
        const prediction = await model.predict(webcam.canvas);

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
    }
</script>