<template>
    <div class="testimonials bg-orange py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <carousel
                            :paginationEnabled="false"
                            :perPage="1"
                            :navigate-to="page"
                    >
                        <slide>
                            <img class="image" src="/images/v2/opinia_persona.png">
                        </slide>
                        <slide>
                            <img class="image" src="/images/v2/opinia_persona.png">
                        </slide>
                    </carousel>
                </div>
                <div class="col-md-8 pl-3 d-flex justify-content-between flex-column">
                    <h3 class="text-center">Opinie o naszych usługach:</h3>
                    <carousel
                            :perPage="1"
                            @pageChange="onPageChange"
                            :navigate-to="page"
                    >
                        <slide>
                            <p class="testimonial">Abc</p>
                            <p class="name">Dariusz Skórniewski, Warszawa</p>
                        </slide>
                        <slide>
                            <p class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nisi
                                nunc, tempus eget tortor non, feugiat finibus ligula. Nam massa felis, laoreet non magna
                                sit amet, faucibus egestas diam. Quisque neque risus, lacinia eu elit consequat,
                                interdum pellentesque lectus. Maecenas in dui ante. Donec posuere et lectus eu mollis.
                                Mauris nisi nisl, molestie non porta elementum, efficitur ac leo. Maecenas rutrum
                                porttitor lorem, quis posuere massa interdum nec.
                            </p>
                            <p class="name">Antoni Brzęczyszczykiwicz</p>
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

        data() {
            return {
                page: 0,
            }
        },

        methods: {
            onPageChange(page) {
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