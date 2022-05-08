require('./bootstrap');
window.Vue = require('vue');

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
import VTooltip from 'v-tooltip';
import VimeoVideo from './components/VimeoVideo.vue';
import Quicksale from './components/Quicksale.vue';
import P30Slider from "./components/p30/P30Slider";
import MainSlider from "./components/internetowisprzedawcy/MainSlider";
import OpinionsSlider from "./components/internetowisprzedawcy/OpinionsSlider";
import FaqAccordion from "./components/internetowisprzedawcy/FaqAccordion";
import Groupon from "./components/Admin/Groupon";
import Baselinker from "./components/Admin/Baselinker";
import Access from "./components/Admin/Access";
import PaymentMethod from "./components/Admin/PaymentMethod";
import CoursesSelector from "./components/Admin/CoursesSelector";
import Order from "./components/internetowisprzedawcy/Order";
import QuestionForm from "./components/internetowisprzedawcy/QuestionForm";
import FormAnswers from "./components/Admin/FormAnswers";

import {VuejsDatatableFactory} from 'vuejs-datatable';

Vue.use(VuejsDatatableFactory);

import VueClipboard from 'vue-clipboard2';

Vue.use(VueClipboard);

import VueFlashMessage from 'vue-flash-message';

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
        'new-logbook-entry': require('./components/NewLogbookEntry').default,
        'ranking-user': RankingUser,
        'partner-link': PartnerLink,
        'quicksale': Quicksale,
        P30Slider,
        'main-slider': MainSlider,
        'opinions-slider': OpinionsSlider,
        'faq-accordion': FaqAccordion,
        Groupon,
        Baselinker,
        Access,
        'payment-method': PaymentMethod,
        'courses-selector': CoursesSelector,
        'analytics': require('./components/Admin/Analytics').default,
        'model-selector': require('./components/Admin/ModelSelector').default,
        'image-preview': require('./components/ImagePreview').default,
        'logbook': require('./components/Admin/Logbook').default,
        'vimeo-video': VimeoVideo,
        Order,
        'question-form': QuestionForm,
        'form-answers': FormAnswers
    }
});

window.app = app;
