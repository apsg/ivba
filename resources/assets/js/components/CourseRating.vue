<template>
    <div>
        <h4>Twoja ocena tego kursu</h4>
        <p>Jak oceniasz ten kurs?</p>
        <div class="star-rating">
            <div class="star-rating__wrap">
                <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5"
                       v-model="current" @change="onChange">
                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
                <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4"
                       v-model="current" @change="onChange">
                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
                <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3"
                       v-model="current" @change="onChange">
                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
                <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2"
                       v-model="current" @change="onChange">
                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
                <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1"
                       v-model="current" @change="onChange">
                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CourseRating",
        props: {
            course: null,
            rating: null,
        },

        data() {
            return {
                current: 0,
            };
        },

        mounted() {
            this.current = this.rating;
        },

        methods: {
            onChange() {
                console.log(this.current);

                axios.post('/learn/course/' + this.course + '/rate', {
                    rating: this.current
                });
            }
        },

    }
</script>

<style scoped lang="scss">

    .star-rating {
        font-size: 0;
    }

    .star-rating__wrap {
        display: inline-block;
        font-size: 1rem;
    }

    .star-rating__wrap:after {
        content: "";
        display: table;
        clear: both;
    }

    .star-rating__ico {
        float: right;
        padding-left: 2px;
        cursor: pointer;
        color: #FFB300;
    }

    .star-rating__ico:last-child {
        padding-left: 0;
    }

    .star-rating__input {
        display: none;
    }

    .star-rating__ico:hover:before,
    .star-rating__ico:hover ~ .star-rating__ico:before,
    .star-rating__input:checked ~ .star-rating__ico:before {
        content: "\f005";
    }

    .rating {
        font-size: 25px;
    }
</style>