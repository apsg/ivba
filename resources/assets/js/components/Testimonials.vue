<template>
    <div class="testimonials bg-orange py-5">
        <div class="container">
            <h3 class="text-center text-testimonials-header">Opinie o naszych usługach:</h3>
            <carousel
                    :paginationEnabled="true"
                    :perPage="1"
                    :navigate-to="page"
                    :mouseDrag="true"
            >
                <slide>
                    <div class="row">

                        <div class="col-md-4 text-center">
                            <img class="image" src="/images/v2/ez.png">
                        </div>
                        <div class="col-md-8 pl-3 d-flex justify-content-between flex-column pt-5">

                            <p class="testimonial">Dzięki Mateuszowi i jego procesom optymalizacji nasz sklep odniósł sukces. Jesteśmy jednym z 3 największych sklepów w PL sprzedających prezenty.
                            <p class="name">Paweł Gubrynowicz www.prezentzycia.pl</p>
                        </div>
                    </div>
                </slide>
                <slide>
                    <div class="row">

                        <div class="col-md-4 text-center">
                            <img class="image" src="/images/v2/mateuszb.png">
                        </div>
                        <div class="col-md-8 pl-3 d-flex justify-content-between flex-column pt-5">
                            <p class="testimonial">Z Mateuszem znamy się od przeszło 6 lat. Systematycznie inspiruje mnie narzędziami i schematami sprzedaży. Czy ogarnia Facebooka? Chyba jak nikt w Polsce :)
                            </p>
                            <p class="name">Mateusz Biernacki www.rekinysukcesu.pl</p>
                        </div>
                    </div>
                </slide>
                <slide>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img class="image" src="/images/v2/barbara.png">
                        </div>
                        <div class="col-md-8 pl-3 d-flex justify-content-between flex-column pt-5">
                            <p class="testimonial">Systematycznie biorę udział w szkoleniach
                                organizowanych przez Mateusza. Mogę to podsumować tylko tak: Trudne zagadnienia tłumaczy
                                w bardzo prosty sposób.
                            </p>
                            <p class="name">Barbara Żukowska (Gliwice)</p>
                        </div>
                    </div>
                </slide>
            </carousel>
        </div>
    </div>
    </div>
    </div>
</template>

<script>
    import {Carousel, Slide} from 'vue-carousel';

    export default {
        components: {Carousel, Slide},

        name: "Testimonials",

        data () {
            return {
                page: 0,
            }
        },

        methods: {
            onPageChange (page) {
                this.page = page;
            }
        }
    }
</script>

<style scoped lang="scss">

    .testimonials {
        background-color: #ff7631;
        color: #fff;
        background-image: radial-gradient(at top, rgba(255, 255, 255, 0.3), transparent, transparent);
        font-size: 1em;
        font-weight: 700;

        .testimonial {
            font-size: 1.2em;
        }

        img {
            max-width: 100%;
        }

        h3 {
            font-weight: 900;
        }
    }

</style>
