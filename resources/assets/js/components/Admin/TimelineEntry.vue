<template>
    <div>
        <div class="d-flex timeline-item my-2 align-items-center">
            <div class="d-flex flex-column align-items-center justify-content-center pl-1">
                <i class="fa fa-clock-o"></i>
            </div>
            <div class="p-3">
                {{ entry.date }}
            </div>
            <div class="p-3 flex-fill" v-html="entry.content">
            </div>
            <div v-if="entry.entry && entry.entry.image_url">
                <image-preview :url="entry.entry.image_url"></image-preview>
            </div>
        </div>
        <div v-if="entry.entry && entry.entry.id">

            <div class="pl-5" v-for="comment in entry.entry.comments">
                <div class="rounded bg-gray-light p-3 mt-1">
                    <div>
                        <span style="white-space: pre-line">{{ comment.comment }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-1 border-2">
                        <div>
                            <i class="fa fa-sm fa-clock-o"></i> {{ comment.created_at }}
                            <i class="ml-5 fa fa-sm fa-user"></i> {{ comment.user.name }}
                        </div>
                        <div>
                            <button class="btn btn-sm btn-danger" @click.prevent="deleteComment(comment.id)">
                                <i class="fa fa-trash"></i> Usuń
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <button
                v-if="!commentBoxVisible"
                class="btn btn-primary btn-sm ml-5"
                @click.prevent="commentBoxVisible = true">
                <i class="fa fa-comment"></i> Dodaj komentarz
            </button>
            <div v-if="commentBoxVisible" class="form-group ml-5">
                <textarea class="form-control" v-model="comment"></textarea>
                <button class="btn btn-primary" @click.prevent="addComment">
                    <i class="fa fa-save"></i> Zapisz
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import ImagePreview from "../ImagePreview";

export default {
    name: "TimelineEntry",
    components: {ImagePreview},
    props: ['entry'],

    data() {
        return {
            commentBoxVisible: false,
            comment: ''
        };
    },

    methods: {
        addComment() {
            axios.post('/admin/logbooks/comments', {
                entry_id: this.entry.entry.id,
                comment: this.comment
            }).then(response => {
                this.commentBoxVisible = false;
                this.comment = '';
                this.entry.entry.comments.push(response.data.comment);
            });
        },

        deleteComment(id) {
            axios.delete('/admin/logbooks/comments/' + id)
                .then(response => {
                    let idx = this.entry.comments.indexOf(item => {
                        item.id = id;
                    });

                    this.entry.comments.splice(idx);
                });
        }
    }
}
</script>

<style lang="scss" scoped>
.timeline-item {
    border-left: 1px black dashed;
    background-color: rgba(100, 240, 123, 0.1);
}
</style>
