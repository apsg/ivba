<template>
    <div class="mx-auto w-50">
        <h3 class="text-center text-orange mb-3">Losowe lekcje</h3>
        <div class="container">
            <carousel
                    :paginationEnabled="false"
                    :navigationEnabled="true">
                <slide v-for="lesson in lessons" :key="lesson.id">
                    <div class="lesson text-orange"
                         :style="`background-image: url('`+lesson.image+`')`">
                        <a :href="lesson.url" :alt="lesson.title">&nbsp;</a>
                    </div>
                </slide>
            </carousel>
            <div class="random-shadow mt-3 mb-5 text-center">
                <img src="/images/v2/Cien_pod_losowymi.png">
            </div>
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
            width: 400px;
            display: flex;
            justify-content: center;
            align-items: stretch;

            a {
                font-size: 40px;
                align-self: center;
                width: 100%;
                height: 100%;
                color: inherit;

                &:hover {
                    text-decoration: none;
                }
            }
        }
    }
</style>