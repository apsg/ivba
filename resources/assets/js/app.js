/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('jquery-ui');
require('jquery-migrate');

window.Vue = require('vue');

import VueClipboard from 'vue-clipboard2';
import VueFlashMessage from 'vue-flash-message';

import Categories from './components/Categories.vue';
import RandomLessons from './components/RandomLessons.vue';
import Testimonials from './components/Testimonials.vue';
import Courses from './components/Courses.vue';
import CourseRating from './components/CourseRating.vue';
import Proofs from './components/Proofs.vue';
import LastLesson from './components/LastLesson.vue';
import ProgressBar from './components/ProgressBar.vue';
import PriceAndCoupon from './components/PriceAndCoupon.vue';
import Ranking from './components/Ranking.vue';
import RankingUser from './components/RankingUser.vue';
import PartnerLink from './components/PartnerLink.vue';
import VTooltip from 'v-tooltip'

Vue.use(VueClipboard);
Vue.use(VueFlashMessage);
Vue.use(VTooltip);

const app = new Vue({
    el: '#app',
    components: {
        Categories,
        RandomLessons,
        Testimonials,
        Courses,
        CourseRating,
        Proofs,
        LastLesson,
        'progress-bar': ProgressBar,
        'price-and-coupon': PriceAndCoupon,
        Ranking,
        'ranking-user': RankingUser,
        'partner-link': PartnerLink,
    }
});

