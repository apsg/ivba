<template>
    <div>
        <div v-if="answer.comment || isSaved">
            <p v-if="!isSaved">{{ answer.comment }}</p>
            <p v-if="isSaved">{{ comment }}</p>
            <div v-if="answer.commenter">
                {{ answer.commented_at }} przez {{ answer.commenter }}
            </div>
        </div>
        <div v-if="!answer.comment && !this.isSaved">
            <textarea v-model="comment" class="form-control"></textarea>
            <button class="btn btn-sm btn-primary" @click.prevent="save">Zapisz komentarz</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "FormAnswerComment",
    props: ['answer'],

    data() {
        return {
            comment: '',
            isSaved: false
        }
    },

    methods: {
        save() {
            if (this.comment.length === 0)
                return;

            axios.post(`/admin/form-answers/${this.answer.id}`, {
                comment: this.comment
            }).then(r => {
                this.isSaved = true;
            });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
