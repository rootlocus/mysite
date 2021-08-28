<script>
import { Bar } from 'vue-chartjs'
    export default {
mixins: [Bar],
        props: {
            data: {
                type: Object,
                default: () => {}
            },
            options: {
                type: Object,
                default: () => {}
            }
        },
        mounted () {
            this.renderChart(this.data, this.options)
        },
    }
</script>