<template>
    <div class="container text-center d-flex pb-3 mt-3 mb-3 mx-auto">
        <carousel
            :loop="true"
            :perPage="1"
            :perPageCustom="[[992, 2], [1340, 3]]"
            :paginationEnabled="false"
            ref="carousel"
            style="width: 100%;"
        >
            <slide v-for="slide in slides" :key="slide.id">
                <div>
                    <img style="max-width: 90%" v-bind:src="'/images/internetowisprzedawcy/' + slide.img">
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
                {
                    id: 1,
                    img: 'seller-1.png',
                    name: 'Paweł Gubrynowicz',
                    description: 'Dzięki Mateuszowi i jego procesom optymalizacji nasz sklep odniósł sukces. Jesteśmy jednym z 3 największych sklepów w PL sprzedających prezenty.',
                    companyName: 'www.prezentyzycia.pl'
                },
                {
                    id: 2,
                    img: 'seller-2.png',
                    name: 'Mateusz Biernacki',
                    description: 'Z Mateuszem znamy się od przeszło 6 lat. Systematycznie inspiruje mnie narzędziami i schematami sprzedaży. Czy ogarnia Facebooka? Chyba jak nikt w Polsce :)',
                    companyName: 'www.rekinysukcesu.pl'
                },
                {
                    id: 3,
                    img: 'seller-3.png',
                    name: 'Barbara Żukowska',
                    description: 'Systematycznie biorę udział w szkoleniach organizowanych przez Mateusza. Mogę to podsumować tylko tak: Trudne zagadnienia tłumaczy w bardzo prosty sposób.',
                    companyName: 'Gliwice'
                }
            ]
        }
    }

}
</script>

<style lang="scss" scoped>
.seller-card {
    &__name {
        font-size: 21px;
    }

    &__description {
        font-size: 14px;
    }

    &__company-name {
        font-weight: 700;
        font-size: 10px;
        text-transform: uppercase;
    }
}
</style>
