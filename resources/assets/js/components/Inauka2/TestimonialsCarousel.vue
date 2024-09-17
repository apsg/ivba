<template>
  <div class="">
    <div class="container">
      <carousel
        :paginationEnabled="false"
        :perPage="1"
        :navigate-to="page"
        :mouseDrag="true"
        :autoplay="true"
        :autoplayTimeout="5000"
      >
        <slide>
          <div class="slide d-flex mt-3 mb-3">
            <div class="align-self-center p-2">
              <img src="/images/inauka2/testimonial.png" />
            </div>
            <div class="align-self-center p-2 flex-grow-1">
              Polecam! Fajny sposób na przypomnienie sobie pracy w Excelu jak i możliwość nauczenia się nowych rzeczy 💪
            </div>
            <div class="align-self-center p-2"><img src="/images/inauka2/logo.svg" height="60"></div>
          </div>
        </slide>
        <slide>
          <div class="slide d-flex mt-3 mb-3">
            <div class="align-self-center p-2">
              <img src="/images/inauka2/testimonial.png" />
            </div>
            <div class="align-self-center p-2 flex-grow-1">
              Polecam! Fajny sposób na przypomnienie sobie pracy w Excelu jak i możliwość nauczenia się nowych rzeczy 💪
            </div>
            <div class="align-self-center p-2"><img src="/images/inauka2/logo.svg" height="60"></div>
          </div>
        </slide>
        <slide>
          <div class="slide d-flex mt-3 mb-3">
            <div class="align-self-center p-2">
              <img src="/images/inauka2/testimonial.png" />
            </div>
            <div class="align-self-center p-2 flex-grow-1">
              Polecam! Fajny sposób na przypomnienie sobie pracy w Excelu jak i możliwość nauczenia się nowych rzeczy 💪
            </div>
            <div class="align-self-center p-2"><img src="/images/inauka2/logo.svg" height="60"></div>
          </div>
        </slide>
      </carousel>
    </div>
  </div>
</template>

<script>
import {Carousel, Slide} from 'vue-carousel';

export default {
  components: {Carousel, Slide},

  name: "TestimonialsCarousel",

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
.slide{
  height: 120px;
  width: 100%;
  background-color: #48CBEA0A;
}
</style>
