<template>
    <div>
        <div class="form-group">
            <label for="count">Liczba kuponów</label>
            <input id="count" class="form-control" type="number" min="1" max="500" v-model="count"/>
        </div>
        <div class="form-group">
            <label>Typ:</label>
            <select v-model="type" class="form-control" @change="loadCourses">
                <option value="0">Procentowy - 100%</option>
                <option value="1">Dostęp do kursu</option>
            </select>
        </div>
        <div class="form-group" v-if="type==1">
            <label>Wybierz przypięte kursy:</label>
            <multiselect
                    :loading="isLoading"
                    v-model="courses"
                    :options="options"
                    :multiple="true"
                    placeholder="Wybierz kursy"
                    label="title"
                    track-by="id">
            </multiselect>
        </div>

        <button class="btn btn-ivba" @click.prevent="generate">Generuj</button>
    </div>
</template>

<script>

    import Multiselect from 'vue-multiselect';

    const FileDownload = require('js-file-download');

    export default {
        name: "Groupon",

        components: {
            Multiselect
        },

        data() {
            return {
                courses: '',
                options: [],
                isLoading: true,
                count: 100,
                type: 0,
            }
        },

        mounted() {

        },

        methods: {
            generate() {
                axios.post('/admin/coupons/groupon', {
                    type: this.type,
                    count: this.count,
                    courses: this.getCourseIds()
                })
                    .then((response) => {
                        FileDownload(response.data, 'kupony.csv');
                    });
            },

            loadCourses() {
                if (this.type != 1)
                    return;

                if (this.courses.length > 0) {
                    this.isLoading = false;

                    return;
                }

                axios.get('/admin/courses/list').then(result => {
                    console.log(result);
                    this.options = result.data;
                    this.isLoading = false;
                })
            },

            getCourseIds() {
                return this.courses.map(c => c.id);
            }
        }

    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

</style>