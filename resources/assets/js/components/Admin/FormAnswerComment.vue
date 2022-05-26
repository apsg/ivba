<template>
    <div class="comment">
        <div v-if="!shouldShowEdit" @click="showEdit">
            <p>{{ this.comment }}</p>
            <div v-if="answer.commenter">
                {{ answer.commented_at }} przez {{ answer.commenter }}
            </div>
        </div>
        <div v-if="shouldShowEdit">
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
            isSaved: false,
            shouldShowEdit: true,
        }
    },

    mounted() {
        this.comment = this.answer.comment;
        if (this.comment.length > 0) {
            this.shouldShowEdit = false;
        }
    },

    methods: {
        save() {
            if (this.comment.length === 0)
                return;

            axios.post(`/admin/form-answers/${this.answer.id}`, {
                comment: this.comment
            }).then(r => {
                this.shouldShowEdit = false;
            });
        },

        showEdit() {
            this.shouldShowEdit = true;
        }
    }
}
</script>

<style lang="scss" scoped>
.comment{
    min-width: 200px;
}
</style>
