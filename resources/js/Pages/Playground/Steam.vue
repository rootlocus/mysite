<template>
    <div class="h-full">
        <section class="bg-gray-750 h-screen">
            <div style="height:600px;width:600px;">
                <vue3-chart-js
                    :id="barChart.id"
                    :type="barChart.type"
                    :data="barChart.data"
                    ref="chartRef"
                ></vue3-chart-js>
                <!-- <vue3-chart-js
                    :id="doughnutChart.id"
                    :type="doughnutChart.type"
                    :data="doughnutChart.data"
                    @before-render="beforeRenderLogic"
                ></vue3-chart-js> -->
            </div>
            <div class="h-screen flex flex-col justify-center items-center">
                <!-- <bar-chart :chartdata="chartData" :options="options"/> -->
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
// import Test from '@/Components/Test';
import { ref } from 'vue';
import Vue3ChartJs from '@j-t-mcc/vue3-chartjs';

export default {
    components: {
            Vue3ChartJs
    },
    props: {
        userData: {
            type: Array,
            default: []
        },
        gameData: {
            type: Array,
            default: []
        },
        type: {
            type: String,
            required: true
        },
        data: {
            type: Object,
            required: true
        },
        options: {
            type: Object,
            default () {
                return {}
            },
        },
        plugins: {
            type: Array,
            default () {
                return []
            }
        }
    },
    setup() {
        const chartRef = ref(null)

        const barChart = {
            id: 'bar',
            type: 'bar',
            data: {
                labels: ['VueJs', 'EmberJs', 'ReactJs', 'AngularJs'],
                datasets: [{
                    backgroundColor: [
                        '#B91C1C',
                        '#B45309',
                        '#047857',
                        '#1D4ED8',
                        '#4338CA',
                        '#6D28D9',
                        '#BE185D',
                    ],
                    data: [40, 20, 80, 10],
                    label:'Time Played',
                    borderWidth: 1
                }]
            }
        }

        const updateChart = (data) => {
            barChart.data.labels = data.meta.games
            barChart.data.datasets = [{
                backgroundColor: [
                    '#B91C1C',
                    '#B45309',
                    '#047857',
                    '#1D4ED8',
                    '#4338CA',
                    '#6D28D9',
                    '#BE185D',
                    '#111827',
                    '#FDE68A',
                    '#A7F3D0',
                ],
                data: data.meta.values,
                label: 'Time Played'
            }]

            chartRef.value.update()
        }

        return {
            barChart,
            updateChart,
            chartRef,
        }
    },
    mounted () {
        this.updateChart(this.gameData.topGames);
    },
    data() {
        return {
            data: {
                steamid: null
            },
        }
    },
    methods: {
        submit() {
            // console.log('test');
            // console.log(route('playground.steam.index'));
            this.$inertia.post(route('playground.steam.submit'), this.data);
            this.updateChart();
        }
    },
}
</script>