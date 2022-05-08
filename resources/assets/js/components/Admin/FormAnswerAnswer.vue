<template>
    <div>
        <div v-if="show" v-html="answer.answer"></div>
        <button @click.prevent="show = !show" class="btn btn-secondary btn-sm">
            <i class="fa fa-eye"></i> Pokaż/ukryj
        </button>
    </div>
</template>

<script>
export default {
    name: "FormAnswerAnswer",
    props: ['answer'],

    data() {
        return {
            show: false
        }
    },

    mounted() {
        this.show = !this.answer.comment;
    }
}
</script>

<style lang="scss" scoped>

</style>
