<template>
    <div class="h-full">
        <section class="bg-gray-750 h-screen">
            <div class="h-screen flex flex-col justify-center items-center">
                <!-- <bar-chart :chartdata="chartData" :options="options"/> -->
                <SteamChart :data="chartData" :options="options"/>
                <Test/>
                <h1 class="title text-white text-4xl">
                    Username: {{ userData.username }} <br>
                    Total Games: {{ gameData.totalGames }} <br>
                    Total Playtime: {{ gameData.totalPlaytime }}
                </h1>
                <div class="text-white">
                    <h2 class="text-3xl">Top 10 Games</h2>
                    <div class="" v-for="game in gameData.topGames.data" :key="game.id">
                        {{ game.name }}
                        {{ game.time }}
                    </div>
                </div>
                <div class="flex flex-row justify-center items-center content-start space-x-10 pt-4 w-full">
                    <div class="relative mr-6 space-x-2">
                        <input v-model="data.steamid" type="search" placeholder="Steam Id (eg; 76561197972495328)" class="bg-purple-white shadow rounded border-0 p-2" style="width: 500px;">
                        <button class="bg-blue-400 hover:bg-blue-dark text-white font-bold px-4 py-2 rounded" @click="submit">Calculate</button>
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
                            <p>Either your steam id provided is invalid, or if the profile is private, friends-only, and other privacy settings are not supported unless you are asking for your own personal details.</p>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
// import { Bar } from 'vue-chartjs';
import SteamChart from '@/Components/SteamChart';
// import Test from '@/Components/Test';

export default {
    // extends: Bar,
    components: {
        SteamChart,
        // Test
    },
    props: {
        userData: {
            type: Array,
            default: []
        },
        gameData: {
            type: Array,
            default: []
        }
    },
    mounted () {
        // this.renderChart(this.chartData, this.options)
    },
    data() {
        return {
            data: {
                steamid: null
            },
            chartData: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }
    },
    methods: {
        submit() {
            // console.log('test');
            // console.log(route('playground.steam.index'));
            this.$inertia.post(route('playground.steam.submit'), this.data);
        }
    },
}
</script>