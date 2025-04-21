<template>
  <div class="col-12 col-sm-6 col-lg-4 col-xl-3 pt-3">
    <div class="d-flex flex-row justify-content-between pb-1 bg-white pt-1 px-1 rounded-top" style="min-height: 32px;">
      <div class="d-flex flex-row flex-wrap gap-2">
        <button v-for="tag in course.tags"
                v-if="tag.is_hidden != true"
                class="btn btn-coral"
                :style="{'background-color': tag.color}"
        >{{ tag.name }}
        </button>
      </div>

      <div class="d-flex flex-row gap-2">
        <span class="subtitle-2">
        <img src="/images/inauka2/icon_star.svg" v-if="course.rating > 0">
          {{ course.rating > 0 ? course.rating : '&nbsp;' }}</span>
      </div>
    </div>
    <div class="card border-0">
      <a :href="course.url">
        <img :src="course.image || '/images/inauka2/courses/placeholder.png'" class="course-img"/>
      </a>
      <div class="card-body">
        <div v-if="course.is_internal" class="d-flex flex-row align-items-center mb-2">
          <i class="icon-verified" style="scale: 50%"></i>
          <span class="overline color-graphite-light">
            EKSPERT INAUKA.PL
          </span>
        </div>
        <span v-else>
            {{ course.author }}
          </span>
        <h5 class="card-title">
          <a :href="course.url">
            {{ course.title }}
          </a>
        </h5>
        <div class="d-flex flex-row flex-wrap gap-3 mb-3">
          <div class="d-flex flex-row flex-nowrap align-items-center gap-2">
            <div class="course-item-background">
              <img src="/images/inauka2/icon_play.svg">
            </div>
            <span class="caption">{{ course.lesson_count }} materiałów</span>
          </div>
          <div class="d-flex flex-row flex-nowrap align-items-center gap-2">
            <div class="course-item-background">
              <img src="/images/inauka2/icon_time.svg">
            </div>
            <span class="caption">{{ course.duration }}</span>
          </div>
        </div>
        <div>
          <p class="body-2 color-graphite-light">
            {{ course.description }}
          </p>
          <p v-if="course.price_full" class="text-price">Cena: {{ course.price_full }} zł</p>
          <a class="d-flex btn btn-blue align-items-center justify-content-center w-100 py-3 mb-1" :href="course.url">
            <i class="icon-arrow-right white"></i>
            <span class="subtitle-1">KUP ZA {{ course.price }} ZŁ</span>
          </a>
          <p class="body-2 color-graphite-light">Najniższa cena w ciągu 30 dni przed obniżką:</p>
        </div>
        <div class="d-flex flex-row flex-wrap gap-2">
          <div v-for="topic in this.topics_arr" class="course-tag">{{ topic }}</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'CourseCard',
  props: {
    course: {
      type: Object,
      required: true
    }
  },

  computed: {
    topics_arr() {
      return this.course.topics.split('\n');
    },
    duration_str() {
      let h = Math.floor(this.course.duration / 60);
      let m = this.course.duration % 60;

      if (h > 0)
        return h + ' godzin ' + m + ' minut';
      else
        return m + ' minut';
    },
    has_rating() {
      return this.course.rating > 0;
    }
  }
}
</script>
<style scoped lang="scss">
.course-img {
  width: 100%;
}
</style>
