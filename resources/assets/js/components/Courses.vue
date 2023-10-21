<template>
  <div class="album py-5 bg-light">
    <div :class=" containerClass ? containerClass : 'container'">
      <div class="row" v-for="group in groups">
        <div class="col-md-12 d-flex my-5">
          <div class="flex-grow-1">
            <hr/>
          </div>
          <div class="pl-5 group-name">
            {{ group.name }}
          </div>
        </div>

        <CourseCard
          v-for="course in group.courses"
          :key="course.id"
          :course="course"
          :ivba="ivba"
          :cc="cardClass"
        ></CourseCard>
      </div>
      <div class="row" v-if="courses.length > 0">
        <div class="col-md-12 d-flex my-5" v-if="groups.length > 0">
          <div class="flex-grow-1">
            <hr/>
          </div>
          <div class="pl-5 group-name">
            Pozostałe kursy
          </div>
        </div>
        <CourseCard
          v-for="course in courses"
          :key="course.id"
          :course="course"
          :ivba="ivba"
          :cc="cardClass"
        ></CourseCard>
      </div>
    </div>
  </div>
</template>

<script>
import CourseCard from "./CourseCard.vue";

export default {
  name: "Courses",
  components: {CourseCard},
  props: {
    ivba: Boolean,
    group: {
      type: Number,
      required: false,
      default: null,
    },
    containerClass: {
      type: String,
      required: false
    },
    cardClass: {
      type: String,
      required: false
    }
  },
  data() {
    return {
      courses: [],
      groups: [],
    }
  },
  filters: {
    truncate: function (text, length, suffix) {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      } else {
        return text;
      }
    },
  },

  mounted() {
    axios.get('/a/courses', {
      params: {
        group: this.group
      }
    }).then(data => {
      this.courses = data.data.courses;
      this.groups = data.data.groups;
    });
  }
}
</script>

<style scoped lang="scss">
.group-name {
  font-size: 18px;
}
</style>
