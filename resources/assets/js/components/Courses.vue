<template>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-4" v-for="course in courses" :key="course.id">
                    <div :class="{ 'ivba-card': ivba }" class="card mb-4 box-shadow">
                        <img :class="{ 'ivba-img': ivba }" class="card-img-top" :src="course.img" alt="Card image cap">
                        <div :class="{ 'ivba-card-body': ivba }" class="card-body">
                            <div :class="{ 'ivba-card-element': ivba }">
                                <h5 :class="{ 'ivba-h5': ivba }" class="card-title">{{ course.title }}</h5>
                                <p v-if="ivba" class="ivba-p card-text pb-3" v-html="$options.filters.truncate(course.excerpt, 80, '...')"></p>
                                <p v-else class="card-text pb-3" v-html="course.excerpt"></p>
                            </div>
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
        props: {
            ivba: Boolean
        },
        data() {
            return {
                courses: [],
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
            axios.get('/a/courses').then(data => this.courses = data.data.data);
        }
    }
</script>

<style scoped lang="scss">
    .ivba-card {
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
        border: none;
    }

    .ivba-img {
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    }

    .ivba-h5 {
        font-size: 1rem;
    }

    .ivba-p {
        font-size: 16px;
    }

    .ivba-card-body {
        min-height: 210px;
    }

    .ivba-card-element {
        min-height: 125px;
    }

</style>