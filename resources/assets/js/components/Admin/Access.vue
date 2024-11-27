<template>
    <div>
        <div>
            <div v-for="access in granted"
                 class="rounded p-2 bg-success-custom text-white access m-1">
                <strong>{{ access.accessable.title }}</strong>
                <span v-if="access.expires_at !== null">(Wygasa: {{ access.expires_at }})</span>

                <button class="ml-2 btn btn-sm btn-danger" @click="revoke(access)">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>

        Wyszukaj kurs by przyznać dostęp:
        <v-select
            v-model="selected"
            :options="options"
            @search="fetchOptions"
            @input="courseSelected"
        ></v-select>
    </div>
</template>

<script>
import vSelect from 'vue-select';

export default {
    name: "Access",

    components: {
        vSelect
    },

    props: ['user'],

    data() {
        return {
            selected: null,
            options: [],
            granted: []
        }
    },

    mounted() {
        axios.get('/admin/access/' + this.user)
            .then(r => {
                this.granted = r.data;
            })
    },

    methods: {
        fetchOptions(search) {
            axios.get('/admin/courses/list?s=' + search)
                .then(r => {
                    this.options = r.data;
                });
        },

        courseSelected(data) {
            console.log(this.selected, data);

            axios.post('/admin/access', {
                user_id: this.user,
                course_id: this.selected.id
            }).then(r => {
                this.granted = r.data;
                this.selected = null;
            });
        },

        revoke(access) {
            console.log(access);
            axios.delete('/admin/access/' + access.id)
                .then(r => {
                    this.granted = r.data;
                });
        }
    }
}
</script>

<style lang="scss" scoped>
.access {
    display: inline-block;
}
</style>
