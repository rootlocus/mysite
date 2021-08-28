<template>
    <div class="h-full">
        <section class="bg-gray-850 h-screen">
            <div class="h-screen flex flex-col justify-center items-center">
                <div class="flex md:flex-row flex-col" v-if="userData">
                    <div class="px-4 py-2 mb-2 bg-gray-750 rounded-md shadow-2xl">
                        <h1 class="title text-white text-2xl">
                            <b>Username: </b>{{ userData.username }} <br>
                            <b>Total Games: </b>{{ gameData.totalGames }} <br>
                            <b>Total Playtime: </b>{{ gameData.totalPlaytime }}
                        </h1>
                    </div>
                </div>
                <div class="flex md:flex-row flex-col space-x-4" v-if="userData">
                    <div class="w-1/2 px-5 bg-gray-750 rounded-md shadow-2xl" style="height:300px;width:600px;">
                        <vue3-chart-js
                            :id="barChart.id"
                            :type="barChart.type"
                            :data="barChart.data"
                            :options="barChart.options"
                            ref="chartRef"
                        ></vue3-chart-js>
                    </div>
                    <div class="w-1/2 text-white bg-gray-750 rounded-md shadow-2xl px-5">
                        <h2 class="text-2xl text-center">Top 10 Games</h2>
                        <ul class="" v-for="game in gameData.topGames.data" :key="game.id">
                            <li> <span class="font-bold">{{ game.name }}</span> - {{ game.time }}</li>
                        </ul>
                    </div>
                </div>
                <div class="flex md:flex-row flex-col space-x-4" v-if="!userData">
                    <h2 class="text-2xl text-center text-white">Profile Not Found. Please check and try again.</h2>
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
    data() {
        return {
            data: {
                steamid: null
            },
        }
    },
    setup() {
        const chartRef = ref(null)

    // {
    //   label: 'Dataset 1',
    //   data: Utils.numbers(NUMBER_CFG),
    //   borderColor: Utils.CHART_COLORS.red,
    //   backgroundColor: Utils.transparentize(Utils.CHART_COLORS.red, 0.5),
    // },
    // {
    //   label: 'Dataset 2',
    //   data: Utils.numbers(NUMBER_CFG),
    //   borderColor: Utils.CHART_COLORS.blue,
    //   backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),
    // }
        const barChart = {
            id: 'bar',
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    backgroundColor: [],
                    data: [],
                    label: '',
                    borderWidth: 1
                },{}]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        ticks: {
                            color: 'white'
                        },
                        title: {
                            display: true,
                            text: 'Game',
                            color: 'white',
                        }
                    },
                    y: {
                        ticks: {
                            color: 'white'
                        },
                        title: {
                            display: true,
                            text: 'Time (min)', 
                            color: 'white',
                        }
                    },
                },
                plugins: {
                    title: {
                        display: true,
                        color: 'white',
                        text: 'Top 10 Steam Games'
                    },
                    legend: {
                        display: false,
                    },
                },
            },
        }

        const updateChart = (data) => {
            console.log(data !== null);
            if (data !== null) {
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
    methods: {
        submit() {
            this.$inertia.get(route('playground.steam.index'), this.data);
        }
    },
}
</script>