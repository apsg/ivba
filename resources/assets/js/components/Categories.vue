<template>
    <div class="container text-center d-flex w-50 pb-3 mx-auto">
        <carousel
                :perPage="4"
                :navigationNextLabel="`>`"
                :navigationPrevLabel="`<`"
                ref="carousel"
                style="width: 100%;"
        >
            <slide>
                <a href="/course/access">
                    <img src="/images/v2/access.png">
                </a>
            </slide>
            <slide>
                <a href="/course/excel-podstawy">
                    <img src="/images/v2/excel_miniaturka.png">
                </a>
            </slide>
            <slide>
                <a href="/course/arkusze-google-podstawy">
                    <img src="/images/v2/dysk_google.png">
                </a>
            </slide>
            <slide>
                <a href="/course/jezyk-sql">
                    <img src="/images/v2/sql_miniaturka.png">
                </a>
            </slide>
            <slide>
                <a href="/course/kurs-adobe-photoshop-podstawy">
                    <img src="/images/v2/photoshop_miniaturka.png">
                </a>
            </slide>
            <slide>
                <a href="/course/powerpoint">
                    <img src="/images/v2/power_point.png">
                </a>
            </slide>
            <slide>
                <a href="/course/power-bi">
                    <img src="/images/v2/powerbi.png">
                </a>
            </slide>
            <slide>
                <a href="/course/kurs-wordpress">
                    <img src="/images/v2/wordpress.png">
                </a>
            </slide>
        </carousel>
    </div>
</template>

<script>
    import {Carousel, Slide} from 'vue-carousel';

    export default {
        name: "Categories",
        components: {Carousel, Slide},

        data() {
            return {
                ready: false,
            }
        },

        mounted() {
            this.ready = true;
        }
    }
</script>

<style scoped>
    a {
        margin: 5px;
    }
</style>
