<template>
    <Head title="Camera"/>
    <div class="min-h-screen bg-white pt-12">
        <div class="flex flex-col justify-center items-center">
            <div>Teachable Machine Image Model</div>
            <button class="bg-blue-400 p-2 rounded" type='button' @click='init'>Start</button>
            <button class="bg-blue-400 p-2 rounded" type='button' @click='predict'>Start</button>

            <div id='webcam-container'></div> CAMERA
            <div id='label-container'></div> NONE
        </div>
    </div>
</template>


<script>
import { Head } from '@inertiajs/inertia-vue3';
import * as tf from '@tensorflow/tfjs';
import * as tmImage from '@teachablemachine/image';

export default {
    components: {
        Head,
    },
    props: {
        products: {
            type: Object,
            default: {}
        },
    },
    data() {
        return {
            model: null,
            webcam: null,
            labelContainer: null,
            maxPredictions: null,
            isIos: false,
            image: null,
        }
    },
    mounted () {
        // this.init();
    },
    methods: {
    // Load the image model and setup the webcam
        async init() {
            const URL = 'https://teachablemachine.withgoogle.com/models/u6av3AjmC/';

            const modelURL = URL + "model.json";
            const metadataURL = URL + "metadata.json";

            // load the model and metadata
            // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
            // or files from your local hard drive
            // Note: the pose library adds "tmImage" object to your window (window.tmImage)
            this.model = await tmImage.load(modelURL, metadataURL);
            this.maxPredictions = this.model.getTotalClasses();

            // Convenience function to setup a webcam
            const flip = true; // whether to flip the webcam
            this.webcam = new tmImage.Webcam(200, 200, flip); // width, height, flip
            await this.webcam.setup(); // request access to the webcam
            await this.webcam.play();
            window.requestAnimationFrame(this.loop);

            // append elements to the DOM
            document.getElementById("webcam-container").appendChild(this.webcam.canvas);
            this.labelContainer = document.getElementById("label-container");
            for (let i = 0; i < this.maxPredictions; i++) { // and class labels
                this.labelContainer.appendChild(document.createElement("div"));
            }
        },
        async loop() {
            this.webcam.update(); // update the webcam frame
            await this.predict();
            window.requestAnimationFrame(this.loop);
        },
        async predict() { // run the webcam image through the image model
            // predict can take in an image, video or canvas html element
            console.log(this.webcam.canvas);
            const prediction = await this.model.predict(this.webcam.canvas);
            for (let i = 0; i < this.maxPredictions; i++) {
                const classPrediction =
                    prediction[i].className + ": " + prediction[i].probability.toFixed(2);
                this.labelContainer.childNodes[i].innerHTML = classPrediction;
            }
        },
    },
}
</script>