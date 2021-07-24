<template>
    <div class="card mt-2">
        <div class="card-header">
            <date-picker
                v-model="selectedRange"
                range
                type="date"
                valueType="date"
                @change="changedDate"
                placeholder="Wybierz zakres (domyślnie: aktualny miesiąc)"
            ></date-picker>
        </div>
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/pl';

export default {
    name: "Analytics",

    components: {
        DatePicker,
    },

    props: ['start', 'end'],

    data() {
        return {
            selectedRange: null,
        }
    },

    mounted() {
        this.selectedRange = [
            new Date(this.start * 1000),
            new Date(this.end * 1000),
        ]
    },

    methods: {
        changedDate() {
            window.location.href = '/admin/analytics?start='
                + (this.selectedRange[0].getTime() / 1000)
                + '&end='
                + (this.selectedRange[1].getTime() / 1000);
        },
    },
}
</script>

<style scoped>
.big {
    font-size: 40px;
}
</style>
