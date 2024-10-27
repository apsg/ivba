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
                  @click="setSort(null)">Domyślnie</a></li>
              <li>
                <a
                  class="dropdown-item"
                  @click="setSort('new')">Nowe produkty</a></li>
              <li>
                <a
                  class="dropdown-item"
                  @click="setSort('cheapest')">Najtańsze</a></li>
              <li>
                <a
                  class="dropdown-item"
                  @click="setSort('expensive')">Najdroższe</a></li>
              <li>
                <a
                  class="dropdown-item"
                  @click="setSort('promotion')">Promocje</a></li>
              <li>
                <a
                  class="dropdown-item"
                  @click="setSort('bestseller')">Bestsellery</a></li>
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

    <div class="">
      <div class="container-fluid px-1 px-md-5 row">
        <CourseCard v-for="course in visible" v-bind:key="course.id" :course="course"></CourseCard>
      </div>
      <div class="text-center d-flex justify-content-center justify-content-md-end">
        <a href="#"
           class="round-button d-flex justify-content-center align-items-center"
           :class="{
            'active': this.offset > 0
           }"
           @click="prev"
        >
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
               fill="currentColor">
            <path d="M640-80 240-480l400-400 71 71-329 329 329 329-71 71Z"/>
          </svg>
        </a>
        <a href="#"
           class="round-button d-flex justify-content-center align-items-center"
           :class="{
            'active': this.hasMore,
           }"
           @click="next"
        >
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
               fill="currentColor">
            <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z"/>
          </svg>
        </a>
      </div>
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
      cols: 4,
      offset: 0,
      limit: 8,
      hasMore: true,
      sort: null,
      search: null,
      courses: [],
      selectedGroup: null,
    }
  },

  mounted() {
    this.loadCourses();

    this.computeCols(window.innerWidth);
    window.addEventListener('resize', () => {
      this.computeCols(window.innerWidth)
    });
  },

  computed: {
    visible() {
      return this.courses.filter((el, id) => {
        return id >= this.offset && id < this.offset + this.limit;
      });
    }
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
          this.offset = 0;
          this.hasMore = this.courses.length > this.limit;
        });
      // }, 300);
    },

    next(e) {
      e.preventDefault();
      if (this.hasMore) {
        this.offset = this.offset + this.limit;
        this.hasMore = this.courses.length > this.offset + this.limit;
      }
    },

    prev(e) {
      e.preventDefault();
      if (this.offset > 0) {
        this.offset = Math.max(0, this.offset - this.limit);
        this.hasMore = this.courses.length > this.offset + this.limit;
      }
    },

    selectGroup(id) {
      if (this.selectedGroup === id) {
        this.selectedGroup = null;
      } else {
        this.selectedGroup = id;
      }
      this.loadCourses();
    },

    setSort(sort) {
      this.sort = sort;
      this.loadCourses();
    },

    computeCols(width) {
      if (width > 1200) {
        this.cols = 4;
        this.limit = 8;
        return;
      }

      if (width > 990) {
        this.cols = 3;
        this.limit = 6;
        return;
      }

      if (width > 580) {
        this.cols = 2;
        this.limit = 4;
        return;
      }

      this.cols = 1;
      this.limit = 5;
    }
  }

}
</script>

<style scoped lang="scss">
.round-button {
  display: flex;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  border: 1px solid #151615cc;
  color: #151615cc;
  text-align: center;
  line-height: 60px;
  margin: 0 10px;

  &.active {
    border-color: #FF6743;
    color: #FF6743;

    &:hover {
      background-color: #FF6743;
      color: #ffffff;
    }
  }
}
</style>
