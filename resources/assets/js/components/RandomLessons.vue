<template>
    <div>
        <h3 class="text-center text-orange mb-3">Losowe lekcje</h3>
        <div class="container">
            <carousel
                    :paginationEnabled="false"
                    :navigationEnabled="true">
                <slide v-for="lesson in lessons">
                    <div class="lesson"
                         :style="`background-image: url('`+lesson.image+`')`">
                        <a :href="lesson.url">{{ lesson.title }}</a>
                    </div>
                </slide>
            </carousel>
        </div>
    </div>
</template>

<script>
    import {Carousel, Slide} from 'vue-carousel';

    export default {
        name: "RandomLessons",

        props: {
            'num': null,
        },

        components: {Carousel, Slide},

        data() {
            return {
                lessons: null,
                current: 0,
            };
        },

        mounted() {
            axios.get('/lessons/random/' + this.num)
                .then(data => {
                    this.lessons = data.data.data;
                    this.lessons[this.current].show = true;
                    this.lessons[this.current + 1].show = true;
                });
        },

        methods: {
            move(direction) {

                let N = this.lessons.length;

                if (direction > 0) {
                    this.lessons[this.current].show = false;
                    this.lessons[this.current + 2].show = true;
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .random-lessons {

        display: flex;

        h3 {
            text-transform: uppercase;
            font-weight: 700;
        }

        .lesson {
            margin: 0 auto;
            background-size: cover;
            background-position: center center;
            height: 300px;
            width: 300px;
        }

        .move {
            display: flex;
            padding: 10px;
            flex-direction: column;
            justify-items: center;
        }
    }
</style>