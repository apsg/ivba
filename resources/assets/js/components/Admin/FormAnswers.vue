<template>
    <div class="container-fluid bg-white">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Data</th>
                <th>Użytkownik</th>
                <th>Odpowiedzi</th>
                <th>Komentarz</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="answer in answers">
                <td>{{ answer.created_at }}</td>
                <td>{{ answer.user }}</td>
                <td class="dont-break-out">
                    <answer :answer="answer"></answer>
                </td>
                <td class="dont-break-out">
                    <comment :answer="answer"></comment>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import FormAnswerComment from "./FormAnswerComment";
import FormAnswerAnswer from "./FormAnswerAnswer";

export default {
    name: "FormAnswers",

    props: ['form'],

    components: {
        'comment': FormAnswerComment,
        'answer': FormAnswerAnswer,
    },

    data() {
        return {
            answers: [],
        }
    },

    mounted() {
        axios.get(`/admin/forms/${this.form.id}/answers`)
            .then(r => {
                this.answers = r.data;
            });
    }
}
</script>

<style lang="scss" scoped>

</style>
