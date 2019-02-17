<template>
    <div class="modal fade" id="lastLessonModal" tabindex="-1" role="dialog" aria-labelledby="lastLessonModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lastLessonModalLabel">Wróć do nauki</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span v-if="!!lesson">Ostatnio realizowana lekcja: {{ lesson }}</span>
                    <span v-if="!!course"> w kursie {{ course }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    <a v-if="!!url" :href="url" class="btn btn-ivba">Kontynuuj naukę</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LastLesson",

        props: {lesson: null, course: null, url: null},

        mounted() {

            this.show();

        },

        methods: {
            show() {
                $('#lastLessonModal').modal({
                    show: true
                });
            }
        }
    }
</script>

<style scoped lang="scss">

</style>