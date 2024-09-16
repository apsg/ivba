<template>
  <div class="container-fluid px-5">
    <div class="row align-items-center">
      <div class="d-none d-md-block col-0 col-md-3">
        <div class="dropdown">
          <div class="d-flex align-items-center">
            <img class="me-4" src="/images/inauka2/sorting-icon.svg" alt="sort icon"/>
            <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Sortuj
                        </span>
            <ul class="dropdown-menu">
              <li>
                <a
                  class="dropdown-item"
                  @click="sort=null">Domyślnie</a></li>
              <li>
                <a
                  class="dropdown-item"
                  @click="sort='new'">Nowe produkty</a></li>
              <li>
                <a
                  class="dropdown-item"
                  @click="sort='cheapest'">Najtańsze</a></li>
              <li>
                <a
                  class="dropdown-item"
                  @click="sort='expensive'">Najdroższe</a></li>
              <li>
                <a
                  class="dropdown-item"
                  @click="sort='promotion'">Promocje</a></li>
              <li>
                <a
                  class="dropdown-item"
                  @click="sort='bestseller'">Bestsellery</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3 px-5 px-lg-0 justify-content-center">
        <div class="d-flex justify-content-center">
          <div class="input-group bg-light p-2 w-100">
            <input type="text"
                   class="form-control border-0"
                   placeholder="Wyszukaj kurs"
                   aria-label="Wyszukaj kurs"
                   aria-describedby="search-text"
                   v-model="search"
                   @change="loadCourses"
            >
            <span class="input-group-text border-0" id="basic-addon2">
                            <i class="icon-search" style="scale: 0.8" aria-hidden="true"></i>
                        </span>
          </div>
        </div>
      </div>
      <div class="d-none d-md-block col-0 col-md-6">
        <slot></slot>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-12">
        <div class="d-flex flex-row gap-4 flex-nowrap scroll-x">
          <button
            v-for="group in groups"
            v-bind:key="group.id"
            @click="selectGroup(group.id)"
            class="filter-item"
            :class="{
              'active' : group.id == selectedGroup
            }"
          >{{ group.name }}
          </button>
        </div>
      </div>
    </div>

    <div class="container-fluid px-1 px-md-5 row">
        <CourseCard v-for="course in courses" v-bind:key="course.id" :course="course"></CourseCard>

    </div>


  </div>

</template>
<script>
import CourseCard from "../Inauka2/CourseCard.vue"
import {debounce} from "lodash";

export default {
  name: 'Courses',
  components: {CourseCard},

  props: {
    groups: {
      type: Array,
      default: [],
    }
  },

  data() {
    return {
      sort: null,
      search: null,
      courses: [],
      selectedGroup: null,
    }
  },

  mounted() {
    this.loadCourses();
  },

  methods: {
    loadCourses() {
      // debounce(() => {
      axios.get('/a/courses', {
        params: {
          sort: this.sort,
          group: this.selectedGroup,
          search: this.search,
          newsearch: 1,
        }
      })
        .then((r) => {
          console.log(r);
          this.courses = r.data.courses;
        });
      // }, 300);
    },

    selectGroup(id) {
      if (this.selectedGroup === id) {
        this.selectedGroup = null;
      } else {
        this.selectedGroup = id;
      }
      this.loadCourses();
    }
  }

}
</script>

<style scoped lang="scss">

</style>
