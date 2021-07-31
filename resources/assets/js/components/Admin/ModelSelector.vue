<template>
    <div>
        <multiselect
            v-model="selected"
            :multiple="true"
            :options="available"
            :searchable="true"
            track-by="id"
            label="title"
            :allow-empty="true"
            :custom-label="customLabel"
        >
        </multiselect>
        <input
            type="hidden"
            v-for="item in selected"
            :name="name+'[]'"
            :value="item.id"
        />
    </div>
</template>

<script>

import Multiselect from "vue-multiselect";

export default {
    name: "ModelSelector",

    components: {
        'multiselect': Multiselect
    },

    props: ['models', 'initial', 'name', 'url', 'label'],

    data() {
        return {
            selected: [],
            available: []
        }
    },

    mounted() {
        if (this.models && this.models.length > 0) {
            this.available = this.models;
            this.preselect();
        } else {
            axios.get(this.url)
                .then((data) => {
                    this.available = data.data;
                    this.preselect();
                });
        }
    },

    methods: {
        customLabel(item) {
            return this.label.map((el) => item[el]).join(' - ');
        },

        preselect() {
            this.selected.push(...this.available.filter((item) => this.initial.includes(item.id)));
        }
    },
}
</script>

<style scoped>

</style>
