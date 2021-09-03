<template>
    <Head title="Steam Infographics"/>
    <div class="min-h-screen bg-gray-850 pt-20">
        <div class="py-10 px-4 md:px-20 space-y-4">
            <div class="">
                <h1 class="title font-semibold text-white text-center text-2xl">STEAM INFOGRAPICS</h1>
                <div class="flex flex-row space-x-2">
                    <input v-model="data.steamid" type="search" placeholder="Steam Id (eg; 76561197972495328)" class="w-full p-2 bg-purple-white shadow rounded border-0">
                    <button class="bg-blue-400 hover:bg-blue-dark text-white font-bold px-4 py-2 rounded" @click="submit">Search</button>
                </div>
                <p class="text-sm text-red-500" v-if="!userData">Profile Not Found. Please check and try again.</p>
            </div>
            <div class="flex flex-col justify-center" v-if="userData">
                <div class="px-4 py-2 mb-2 bg-gray-750 rounded-md shadow-2xl">
                    <h1 class="title text-white text-l md:text-xl lg:text-2xl">
                        <b>Username: </b>{{ userData.username }} <br>
                        <b>Total Games: </b>{{ gameData.totalGames }} <br>
                        <b>Total Playtime: </b>{{ gameData.totalPlaytime }}
                    </h1>
                </div>
            </div>
            <div class="md:space-x-4 md:space-y-0 space-y-4 md:flex">
                <div class="md:w-1/2 bg-gray-750 rounded-md shadow-2xl">
                    <vue3-chart-js
                        :id="barChart.id"
                        :type="barChart.type"
                        :data="barChart.data"
                        :options="barChart.options"
                        ref="chartRef"
                    ></vue3-chart-js>
                </div>
                <div class="md:w-1/2 text-white bg-gray-750 rounded-md shadow-2xl p-4">
                    <h2 class="text-2xl text-center font-semibold">Top 10 Games</h2>
                    <table class="table-fixed border-2 border-gray-500 w-full content">
                        <tr class="border-2 border-gray-500">
                            <th class="w-1/2 border-2 border-gray-500">Name</th>
                            <th class="w-1/2 border-2 border-gray-500">Time Played</th>
                        </tr>
                        <tr v-for="game in gameData.topGames.data" :key="game.id" class="border-2 border-gray-500">
                            <td class="border-2 border-gray-500">{{ game.name }}</td>
                            <td class="border-2 border-gray-500">{{ game.time }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="px-8 pb-8 md:px-20 space-y-4">
            <div class="text-white content">
                <h2 class="text-2xl font-bold">FAQ</h2>
                API:  <a class="text-blue-700" href="https://steamcommunity.com/dev">https://steamcommunity.com/dev</a>
                <ol class="list-decimal space-y-2">
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
    </div>
</template>

<script>
import { ref } from 'vue';
import Vue3ChartJs from '@j-t-mcc/vue3-chartjs';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Vue3ChartJs,
        Head,
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
                    label: 'Time Played(min)'
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
            console.log(route('playground.steam.index'));
            this.$inertia.get(route('playground.steam.index'), this.data);
        }
    },
}
</script>