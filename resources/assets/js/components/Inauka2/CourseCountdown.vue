<template>
  <div class="d-flex w-100 justify-content-center">
    <div class="box">
      <div class="inner rounded h4-headline">
        {{ this.hours }}
      </div>
      <div class="caption pt-1">
        godzin
      </div>
    </div>
    <div class="divider px-2 h4-headline">
      :
    </div>
    <div class="box">
      <div class="inner rounded h4-headline">
        {{ this.minutes }}
      </div>
      <div class="caption pt-1">
        minut
      </div>
    </div>
    <div class="divider px-2 h4-headline">
      :
    </div>
    <div class="box">
      <div class="inner rounded h4-headline">
        {{ this.seconds }}
      </div>
      <div class="caption pt-1">
        sekund
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";

export default {
  name: "CourseCountdown",

  props: {
    timestamp: {
      type: Number
    }
  },

  data() {
    return {
      difference: null,
    }
  },

  computed: {
    hours: function () {
      if (this.difference === null) {
        return 0;
      }

      return this.difference.days()*24+this.difference.hours();
    },
    minutes: function () {
      if (this.difference === null) {
        return 0;
      }

      return this.difference.minutes();
    },
    seconds: function () {
      if (this.difference === null) {
        return 0;
      }

      return this.difference.seconds();
    }
  },

  mounted() {
    let now = moment(new Date());
    let end = moment(new Date(this.timestamp * 1000));

    if (end.isBefore(now)){
      return;
    }

    this.difference = moment.duration(end.diff(now));

    this.tick();
  },

  methods: {
    tick() {
      if (this.seconds === 0 && this.minutes === 0 && this.hours === 0) {
        return;
      }

      this.difference = this.difference.subtract(1, 's');

      setTimeout(() => {
        this.tick()
      }, 1000);
    }
  }
}
</script>

<style scoped lang="scss">
@import "../../../sass/inauka2/colors";

.box {
  .inner {
    width: 70px;
    height: 70px;
    background-color: $color-coral;
    text-align: center;
    line-height: 70px;
    color: white;

    @media (max-width: 1280px){
      width: 50px;
    }

    @media (max-width: 1024px){
      width: 40px;
    }

    @media (max-width: 764px){
      width: 70px;
    }
  }
}

.divider {
  line-height: 70px;
}

.caption{
  text-transform: uppercase;
  font-size: 10px;
}
</style>
