<template>
    <div class="container random-lessons">
        <h3 class="text-center text-orange mb-3">Losowe lekcje</h3>
        <div class="lesson" v-for="lesson in lessons" :style="`background-image: url('`+lesson.image+`')`">
            <a :href="lesson.url">{{ lesson.title }}</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RandomLessons",

        props: {
            'num': null,
        },

        data() {
            return {
                lessons: null,
            };
        },

        mounted() {
            axios.get('/lessons/random/' + this.num)
                .then(data => this.lessons = data.data.data);
        }
    }
</script>

<style scoped lang="scss">
    .random-lessons {
        h3 {
            text-transform: uppercase;
            font-weight: 700;
        }

        .lesson {
            background-size: contain;
            background-position: center center;
        }
    }
</style>