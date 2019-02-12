<template>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-4" v-for="course in courses" :key="course.id">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" :src="course.img" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ course.title }}</h5>
                            <p class="card-text" v-html="course.excerpt"></p>
                            <a v-if="course.wait == 0" :href="course.url" class="btn btn-ivba">Rozpocznij kurs</a>
                            <span v-else class="border py-2 px-3"><i class="fa fa-clock-o"></i> Uzyskasz dostęp za {{ course.wait }} dni</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Courses",

        data() {
            return {
                courses: [],
            }
        },

        mounted() {
            axios.get('/a/courses').then(data => this.courses = data.data.data);
        }
    }
</script>

<style scoped lang="scss">

</style>