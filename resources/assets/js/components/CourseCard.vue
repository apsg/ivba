<template>
    <div class="col-md-4" style="position: relative;">
        <div v-if="course.finished" class="finished p-1 rounded rounded-50 text-bold">
            <i class="fa fa-check-square-o"></i> Ukończono
        </div>
        <div :class="{ 'ivba-card': ivba }" class="card mb-4 box-shadow">
            <img :class="{ 'ivba-img': ivba }" class="card-img-top" :src="course.img" alt="Card image cap">
            <div :class="{ 'ivba-card-body': ivba }" class="card-body">
                <div :class="{ 'ivba-card-element': ivba }">
                    <h5 :class="{ 'ivba-h5': ivba }" class="card-title">{{ course.title }}</h5>
                    <p v-if="ivba" class="ivba-p card-text pb-3"
                       v-html="$options.filters.truncate(course.excerpt, 80, '...')"></p>
                    <p v-else class="card-text pb-3" v-html="course.excerpt"></p>
                </div>
                <a v-if="course.wait == 0" :href="course.url" class="btn btn-ivba">Rozpocznij kurs</a>
                <span v-else class="border py-2 px-3"><i class="fa fa-clock-o"></i> Uzyskasz dostęp za {{ course.wait }} dni</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CourseCard",

    props: ['course','ivba'],

    filters: {
        truncate: function (text, length, suffix) {
            if (text.length > length) {
                return text.substring(0, length) + suffix;
            } else {
                return text;
            }
        },
    },
}
</script>

<style scoped>
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

.finished {
    position: absolute;
    z-index: 100;
    background-color: #70d069;
    color: #fff;
    right: 0;
    top: -10px;
}
</style>
