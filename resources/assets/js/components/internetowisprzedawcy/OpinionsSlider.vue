<template>
    <div class="container text-center d-flex pb-3 mt-3 mb-3 mx-auto">
        <carousel
            :loop="true"
            :perPageCustom="[[576, 1], [992, 2], [1340, 3]]"
            :paginationEnabled="false"
            ref="carousel"
            style="width: 100%;"
        >
            <slide v-for="slide in slides" :key="slide.id">
                <div>
                    <img v-bind:src="'/images/internetowisprzedawcy/' + slide.img">
                </div>
                <div class="p-5">
                    <div class="p-2">
                        <h2 class="seller-card__name">{{ slide.name }}</h2>
                    </div>
                    <div class="p-2">
                        <p class="seller-card__description">{{ slide.description }}</p>
                    </div>
                    <div class="p-2">
                        <span class="seller-card__company-name">{{ slide.companyName }}</span>
                    </div>
                </div>
            </slide>
        </carousel>
    </div>
</template>

<script>
    import {Carousel, Slide} from 'vue-carousel';

    export default {
        name: "OpinionsSlider",
        components: {Carousel, Slide},
        data() {
            return {
                slides: [
                    {   id: 1,
                        img: 'seller.png',
                        name: 'Paweł Kowalski',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        companyName: 'nazwa firmy'
                    },
                    {   id: 2,
                        img: 'seller-2.png',
                        name: 'Paweł Kowalski',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        companyName: 'story 0.1'
                    },
                    {   id: 3,
                        img: 'seller.png',
                        name: 'Paweł Kowalski',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        companyName: 'story 0.1'
                    },
                    {   id: 4,
                        img: 'seller-2.png',
                        name: 'Paweł Kowalski',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        companyName: 'story 0.1'
                    },
                    {   id: 5,
                        img: 'seller.png',
                        name: 'Paweł Kowalski',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        companyName: 'story 0.1'
                    },
                ]
            }
        }

    }
</script>

<style lang="scss" scoped>
    .seller-card {
        &__name{
            font-size: 21px;
        }
        
        &__description{
            font-size: 14px;
        }

        &__company-name{
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
        }
    }
</style>
