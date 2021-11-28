<template>
    <div class="container text-center d-flex pb-3 mt-3 mb-3 mx-auto">
        <carousel
            :perPage="1"
            :navigationNextLabel="`>`"
            :navigationPrevLabel="`<`"
            paginationColor="#FFFFFF8B"
            paginationActiveColor="#FFF"
            ref="carousel"
            style="width: 100%;"
            class="main-slider"
        >
            <slide>
                <div class="row h-100">
                    <div class="col-12 d-flex align-items-center slider-image" style="background-image: url(/images/internetowisprzedawcy/nowa-ilustracja.png)">
                        <div class="slide-text text-left">
                            <h1>Rozwiń sprzedaż<br> Do perfekcji</h1>
                            <span>Wszystkie teksty na stronach są tekstami przykładowymi</span>
                        </div>
                    </div>
                </div>
            </slide>
            <slide>
                <div class="row h-100">
                    <div class="col-12 d-flex align-items-center slider-image" style="background-image: url(/images/internetowisprzedawcy/ilustracja3d_druga.png)">
                        <div class="slide-text text-left">
                            <h1>Rozwiń sprzedaż 2<br> Do perfekcji</h1>
                            <span>Wszystkie teksty na stronach są tekstami przykładowymi</span>
                        </div>
                    </div>
                </div>
            </slide>
        </carousel>
    </div>
</template>

<script>
    import {Carousel, Slide} from 'vue-carousel';

    export default {
        name: "MainSlider",
        components: {Carousel, Slide},

    }
</script>

<style lang="scss" scoped>
    .slider-image {
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        background-size: 85%;
    }

    @media (max-width: 1200px) {
        .slider-image {
            background-size: 110%;
        }
    }

    .slide-text{
        h1 {
            font-size: 54px;
            line-height: 1.2em;
            color: #F5FFFF;
        }
        span {
            font-size: 22px;
            color: #F5FFFF;
            font-weight: 100;
        }

    } 
</style>
