<template>
    <div class="container text-center d-flex pb-3 mt-3 mb-3 mx-auto">
        <carousel
            :perPage="1"
            :navigationNextLabel="`>`"
            :navigationPrevLabel="`<`"
            ref="carousel"
            style="width: 100%;"
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
            <!-- <slide>
                <div class="row h-100">
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <img class="w-100" src="/images/projekt30/grupa.png">
                    </div>
                    <div class="col-sm-6 d-flex align-items-center justify-content-center">
                        <div class="text-left">
                            <p>Spokojnie nie pogubisz się. Przygotowaliśmy dla Ciebie checklisty.</p>
                        </div>
                    </div>
                </div>
            </slide> -->
        </carousel>
    </div>
</template>

<script>
    import {Carousel, Slide} from 'vue-carousel';

    export default {
        name: "InternetowiSprzedawcySlider",
        components: {Carousel, Slide},

    }
</script>

<style scoped>
    .slider-image {
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        background-size: 85%;
    }

    .slide-text h1{
        font-size: 54px;
        line-height: 1.2em;
        color: #F5FFFF;
    }

    .slide-text span{
        font-size: 22px;
        color: #F5FFFF;
        font-weight: 100;
    }
</style>
