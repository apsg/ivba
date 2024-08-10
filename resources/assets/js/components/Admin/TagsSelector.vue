<template>
  <div>
    <multiselect
      v-model="selected"
      :multiple="true"
      :options="tags"
      :searchable="true"
      track-by="id"
      label="title"
      :allow-empty="true"
      :custom-label="customLabel"
      @input="onChange"
    >
    </multiselect>
    <input
      type="hidden"
      v-for="item in selected"
      name="tag_id[]"
      :value="item.id"
    />
  </div>
</template>

<script>

import Multiselect from "vue-multiselect";

export default {
  name: "TagsSelector",

  components: {
    'multiselect': Multiselect
  },

  props: ['tags', 'initial', 'course_id'],

  data() {
    return {
      selected: []
    }
  },

  mounted() {
    this.selected.push(...this.tags.filter((tag) => this.initial.includes(tag.id)));
    console.log(this.initial);
  },

  methods: {
    customLabel({id, name}) {
      return `#${id} - ${name}`;
    },
    onChange() {
      console.log(this.selected);
      axios.post(`/admin/courses/${this.course_id}/tags`, {
        'tags': this.selected.map(function (tag) {
          return tag.id
        })
      }).then(() => {

      });
    }
  },
}
</script>

<style scoped>

</style>
