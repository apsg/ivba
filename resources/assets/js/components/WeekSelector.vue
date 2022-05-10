<template>
    <div>
        <date-picker
            v-model="date"
            :formatter="formatter"
            @change="changed"
            required
            :input-attr="{name:'date'}"
            type="week"></date-picker>
        <input type="hidden" v-model="year" :name="name+'year'">
        <input type="hidden" v-model="week" :name="name">
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "WeekSelector",

    props: ['name'],

    data() {
        return {
            date: null,
            formatter: this.dateFormatter(),
            week: null,
            year: null
        }
    },

    methods: {
        dateFormatter() {
            return {
                stringify: (date) => {
                    return moment(date).startOf('isoWeek').format('D.MM')
                        + '-'
                        + moment(date).endOf('isoWeek').format('D.MM.YYYY')
                }
            }
        },

        changed() {
            if (!this.date) {
                this.week = null;
            }

            this.week = moment(this.date).week();
            this.year = moment(this.date).year();
        },

        computed: {
            year() {
                return moment(this.date).year();
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
