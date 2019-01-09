<template>
    <div class="container text-center d-flex w-50 pb-3">
        <carousel
                :perPage="4"
                :navigationNextLabel="`>`"
                :navigationPrevLabel="`<`"
                ref="carousel"
                style="width: 100%;"
        >
            <slide>
                <a href="#">
                    <img src="/images/v2/excel_miniaturka.png">
                </a>
            </slide>
            <slide>
                <a href="#">
                    <img src="/images/v2/photoshop_miniaturka.png">
                </a>
            </slide>
            <slide>
                <a href="#">
                    <img src="/images/v2/photoshop_miniaturka.png">
                </a>
            </slide>
            <slide>
                <a href="#">
                    <img src="/images/v2/photoshop_miniaturka.png">
                </a>
            </slide>
            <slide>
                <a href="#">
                    <img src="/images/v2/excel_miniaturka.png">
                </a>
            </slide>
            <slide>
                <a href="#">
                    <img src="/images/v2/photoshop_miniaturka.png">
                </a>
            </slide>
            <slide>
                <a href="#">
                    <img src="/images/v2/photoshop_miniaturka.png">
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

    .VueCarousel-navigation-button {
        color: #fff;
        font-size: 40px;
        font-family: "Lato", "Raleway", sans-serif;
        font-weight: 300;
    }
</style>