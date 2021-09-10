<template>
    <div class="p-3">
        <h3>Dodaj nowy wpis w dzienniku</h3>

        <div class="alert alert-danger" v-if="errors">
            <ul>
                <li v-for="error of errors">{{ error[0] }}</li>
            </ul>
        </div>

        <div class="alert alert-success" v-if="success">
            Dodano wpis!
        </div>

        <div class="form-group" v-show="!hasOneLogbook">
            <label>Wybierz dziennik aktywności:</label>
            <select v-model="logbook_id" class="form-control">
                <option
                    v-for="logbook in logbooks"
                    :value="logbook.id"
                    :selected="hasOneLogbook">{{ logbook.title }}
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Tytuł: </label>
            <input name="title" class="form-control" v-model="title">
        </div>

        <div class="form-group">
            <label>Opis: </label>
            <textarea name="description" class="form-control" v-model="description"></textarea>
        </div>

        <div class="form-group">
            <label>Załaduj zdjęcie (opcjonalnie):</label>
            <input type="file"
                   accept="image/png, image/jpeg"
                   ref="image"
                   name="image"
                   class="form-control"
                   v-on:change="handleFileUpload">
        </div>

        <button class="btn btn-ivba mt-3" @click="send">
            <i class="fa fa-save"></i> Dodaj wpis
        </button>
    </div>
</template>

<script>
export default {
    name: "NewLogbookEntry",

    props: ['course'],

    data() {
        return {
            logbooks: [],
            logbook_id: null,
            title: '',
            description: '',
            file: null,
            errors: null,
            success: false
        };
    },

    mounted() {
        this.fetchLogbooks();
    },

    methods: {

        send() {
            this.errors = null;
            this.success = false;

            let formData = new FormData();
            formData.append('image', this.file);
            formData.append('title', this.title);
            formData.append('description', this.description);

            axios.post('/learn/course/' + this.course + '/logbook/' + this.logbook_id,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.clearForm();
                    this.success = true;
                })
                .catch(response => {
                    this.success = false;
                    this.errors = response.response.data.errors;
                });
        },

        clearForm() {
            this.title = '';
            this.description = '';
            this.file = null;
            this.errors = null;
        },

        handleFileUpload() {
            console.log(this.$refs.image.files);
            this.file = this.$refs.image.files[0];
        },

        fetchLogbooks() {
            axios.get('/learn/course/' + this.course + '/logbooks')
                .then((data) => {
                        this.logbooks = data.data;

                        if (this.hasOneLogbook) {
                            this.logbook_id = this.logbooks[0].id;
                        }
                    }
                );
        }
    },

    computed: {
        hasOneLogbook() {
            return this.logbooks.length === 1;
        }
    }
}
</script>

<style scoped>

</style>
