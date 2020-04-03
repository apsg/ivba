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
                            <img class="image" src="/images/v2/lukasz_kutylowski.png">
                        </div>
                        <div class="col-md-8 pl-3 d-flex justify-content-between flex-column pt-5">

                            <p class="testimonial">Szkolenia z Excela pozwoliły mi na
                                prowadzenie szeregu usprawnień w firmie. Pomimo ciągłej pracy na excelu, moje analizy są
                                teraz zdecydowanie bardziej profesjonalne. Nie ma w Polsce drugiej takiej firmy, która w
                                tak przyswajalny sposób potrafi przekazać wiedzę. Osobiście – bardzo polecam! Dzięki i
                                widzimy się na kolejnej konferencji
                            <p class="name">Łukasz Kutyłowski W-wa</p>
                        </div>
                    </div>
                </slide>
                <slide>
                    <div class="row">

                        <div class="col-md-4 text-center">
                            <img class="image" src="/images/v2/damian_klekot.png">
                        </div>
                        <div class="col-md-8 pl-3 d-flex justify-content-between flex-column pt-5">
                            <p class="testimonial">Środowa konferencja była pierwszą i na pewno
                                nie ostatnią. Zdecydowanie polecam. Super atmosfera a wiedza przekazywana w bardzo
                                przystępny sposób!
                            </p>
                            <p class="name">Damian Klekot (Warszawa)</p>
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
