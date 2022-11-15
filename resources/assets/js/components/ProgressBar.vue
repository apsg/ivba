<template>
    <div>
        <div class="progress-container" :style="`--width: ${p}%; --background: ${color}`">
            <progress
                    v-if="progress"
                    :value="finished"
                    :max="total"
            ></progress>
        </div>
        <a v-if="progress" v-tooltip="'Postęp: '+ finished +'/'+total+' ('+ p +'%)'">{{ p }}%</a>

        <div class="progress-container" :style="`--width: ${p}%; --background: ${color}`">
            <progress v-if="!progress"></progress>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProgressBar",

        props: {
            slug: {
                type: String,
                default: '',
            },
            color: {
                type: String,
                default: '#007bff',
            },
        },

        data() {
            return {
                progress: null,
                total: null,
                finished: null,
            }
        },

        mounted() {
            axios.get('/learn/course/' + this.slug + '/progress')
                .then(data => {
                    this.progress = data.data.progress;
                    this.total = data.data.total;
                    this.finished = data.data.finished;
                });
        },

        computed: {
            p() {
                if (!this.progress)
                    return 0;

                return (100 * this.progress).toFixed(2);
            }
        }

    }
</script>

<style scoped lang="scss">
/* For Chrome or Safari */
    progress {
        opacity: 0;
    }
    .progress-container {
        margin-bottom: 1.5px;   
        position: relative;
        display: inline-block;
        background: #eee;
        height: 7px;
        border-radius: 6px;
        overflow: hidden;
    }
    .progress-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: var(--width);
        background: var(--background);
    }
</style>