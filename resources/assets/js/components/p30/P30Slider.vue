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
                <div class="row">
                    <div class="col-md-6">
                        <img class="w-100" src="/images/projekt30/checklisty.png">
                    </div>
                    <div class="col-sm-6 text-left">
                        <h3>Checklisty2</h3>
                        <p>Lorem ipsum dolor sit</p>
                        <a href="" class="btn btn-p30-red">Link</a>
                    </div>
                </div>
            </slide>
            <slide>
                <div class="row">
                    <div class="col-md-6">
                        <img class="w-100" src="/images/projekt30/darmowa-porada.png">
                    </div>
                    <div class="col-sm-6 text-left">
                        <h3>Darmowa porada</h3>
                        <p>Lorem ipsum dolor sit</p>
                        <a href="" class="btn btn-p30-red">Link</a>
                    </div>
                </div>
            </slide>
            <slide>
                <div class="row">
                    <div class="col-md-6">
                        <img class="w-100" src="/images/projekt30/grupa.png">
                    </div>
                    <div class="col-sm-6 text-left">
                        <h3>Grupa</h3>
                        <p>Lorem ipsum dolor sit</p>
                        <a href="" class="btn btn-p30-red">Link</a>
                    </div>
                </div>
            </slide>
            <slide>
                <div class="row">
                    <div class="col-md-6">
                        <img class="w-100" src="/images/projekt30/nagrania-konfa.png">
                    </div>
                    <div class="col-sm-6 text-left">
                        <h3>Nagrania konfa</h3>
                        <p>Lorem ipsum dolor sit</p>
                        <a href="" class="btn btn-p30-red">Link</a>
                    </div>
                </div>
            </slide>
        </carousel>
    </div>
</template>

<script>
    import {Carousel, Slide} from 'vue-carousel';

    export default {
        name: "P30Slider",
        components: {Carousel, Slide},

    }
</script>

<style scoped>
    h3 {
        font-weight: 900 !important;
    }

    p{
        font-size: 1.2rem;
    }
</style>
