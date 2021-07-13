<template>
    <div>
        <multiselect
            v-model="selected"
            :multiple="true"
            :options="courses"
            :searchable="true"
            track-by="id"
            label="title"
            :allow-empty="false"
            :custom-label="customLabel"
        >
        </multiselect>
        <input
            type="hidden"
            v-for="item in selected"
            name="course_id[]"
            :value="item.id"
        />
    </div>
</template>

<script>

import Multiselect from "vue-multiselect";

export default {
    name: "CoursesSelector",

    components: {
        'multiselect': Multiselect
    },

    props: ['courses', 'initial'],

    data() {
        return {
            selected: []
        }
    },

    mounted() {
        this.selected.push(...this.courses.filter((course) => this.initial.includes(course.id)));
    },

    methods: {
        customLabel({id, title}) {
            return `#${id} - ${title}`;
        }
    },
}
</script>

<style scoped>

</style>
