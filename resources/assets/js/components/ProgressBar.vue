<template>
    <div>
        <progress
                v-if="progress"
                :value="finished"
                :max="total"
        ></progress>
        <a v-if="progress" v-tooltip="'Postęp: '+ finished +'/'+total+' ('+ p +'%)'">{{ p }}%</a>

        <progress v-if="!progress"></progress>
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
                default: '',
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

</style>