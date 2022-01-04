<template>
    <div class="container slider-container text-center d-flex mx-auto">
        <carousel
            :perPage="1"
            paginationColor="#FFFFFF8B"
            paginationActiveColor="#FFF"
            ref="carousel"
            style="width: 100%;"
            class="main-slider"
        >
            <slide>
                <div class="row h-100">
                    <div class="col-12 d-flex align-items-center slider-image"
                         style="background-image: url(/images/internetowisprzedawcy/nowa-ilustracja.png)">
                        <div class="slide-text text-left">
                            <h1>Dedykowane<br> materiały<br> biznesowe</h1>
                            <span>Szeroki zakres wiedzy niezbędnej do sprzedaży w Internecie.</span>
                        </div>
                    </div>
                </div>
            </slide>
            <slide>
                <div class="row h-100">
                    <div class="col-12 d-flex align-items-center slider-image"
                         style="background-image: url(/images/internetowisprzedawcy/ilustracja3d_druga.png)">
                        <div class="slide-text text-left">
                            <h1>Społeczność<br> praktyków<br> sprzedaży</h1>
                            <span>
                                Dołącz do nas, aby rozwijać swoją firmę, ucząc się i pracując z najlepszymi.
                            </span>
                        </div>
                    </div>
                </div>
            </slide>
            <slide>
                <div class="row h-100">
                    <div class="col-12 d-flex align-items-center slider-image"
                         style="background-image: url(/images/internetowisprzedawcy/nowa-ilustracja.png)">
                        <div class="slide-text text-left">
                            <h1>Naucz się <br>prowadzić<br> produktywny<br> biznes</h1>
                            <span>
                                Konsultuj na bieżąco swoje rozwiązania i otwieraj się na klienta.
                            </span>
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
    background-position: right;
    background-size: contain;
    background-size: 95%;
}

.slider-container {
    margin-top: 5em;
}

@media (max-height: 950px) {
    .slider-image {
        background-size: 80%;
    }
}

@media (max-height: 845px) {
    .slider-image {
        background-size: 70%;
    }
}

@media (max-height: 780px) {
    .slider-image {
        background-size: 60%;
    }
}

@media (max-height: 728px) {
    .slider-image {
        background-size: 50%;
    }
}

.slide-text {
    padding-left: 5em;
    h1 {
        margin-top: -120px;
        font-size: 54px;
        line-height: 1.2em;
        color: #F5FFFF;
    }

    span {
        font-size: 22px;
        color: #F5FFFF;
        font-weight: 100;
        font-family: 'Poppins';
    }

}

@media (max-width: 767px) {
    .slider-image {
        background-image: url() !important;
    }
}

@media (max-width: 767px) {
    .slider-container {
        margin-top: 0;
    }
    .slide-text {
        padding-left: 0;
    }
    .VueCarousel-slide {
        width: 100% !important;
        h1 {
            font-size: 40px;
        }
        span {
            font-size: 14px;
        };
    }
}
</style>
