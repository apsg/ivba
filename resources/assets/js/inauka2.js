import PartnerLink from "./components/PartnerLink.vue";
import RankingUser from "./components/RankingUser.vue";
import ProgressBar from "./components/ProgressBar.vue";

/**
 * AXIOS
 */
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/**
 * END: AXIOS
 */

import 'material-icons/iconfont/material-icons.css';

window.Vue = require('vue');

import VueClipboard from 'vue-clipboard2';

Vue.use(VueClipboard);

import VueFlashMessage from 'vue-flash-message';
import VTooltip from "v-tooltip";
import CourseCountdown from "./components/Inauka2/CourseCountdown.vue";
import CloudflareVideo from "./components/Inauka2/CloudflareVideo.vue";
import TestimonialsCarousel from "./components/Inauka2/TestimonialsCarousel.vue";
import FaqAccordion from "./components/Inauka2/FaqAccordion.vue";
import Courses from "./components/Inauka2/Courses.vue";
import Overlay from "./components/Inauka2/Overlay.vue";
import ClientOpinionCarousel from "./components/Inauka2/ClientOpinionCarousel.vue";

Vue.use(VueFlashMessage);
Vue.use(VTooltip);

const app = new Vue({
    el: '#app',
    components: {
        'ranking-user': RankingUser,
        'progress-bar': ProgressBar,
        'partner-link': PartnerLink,
        'course-countdown': CourseCountdown,
        'cloudflare-video': CloudflareVideo,
        'testimonials-carousel': TestimonialsCarousel,
        'faq-accordion': FaqAccordion,
        'courses': Courses,
        'overlay': Overlay,
        'client-opinion-carousel': ClientOpinionCarousel,
    }
});

window.app = app;
