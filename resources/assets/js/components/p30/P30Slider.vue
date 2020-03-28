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
                        <h3>Checklisty</h3>
                        <p>Spokojnie nie pogubisz się. Przygotowaliśmy dla Ciebie checklisty.</p>
                        <a href="/checklisty" class="btn btn-p30-red">Zobacz</a>
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
                        <p>Zarejestuj się i sprawdź jak wyglądają nasze darmowe porady.</p>
                        <a href="/darmowe_porady" class="btn btn-p30-red">Zobacz</a>
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
                        <p>Dołącz do 1000 firm, którym pomagamy.</p>
                        <a href="/grupa" class="btn btn-p30-red">Zobacz</a>
                    </div>
                </div>
            </slide>
            <slide>
                <div class="row">
                    <div class="col-md-6">
                        <img class="w-100" src="/images/projekt30/nagrania-konfa.png">
                    </div>
                    <div class="col-sm-6 text-left">
                        <h3>Konferencje on-line</h3>
                        <p>Cykliczne szkolenia on-line tylko dla osób z projektu30</p>
                        <a href="/konferencje" class="btn btn-p30-red">Zobacz</a>
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
