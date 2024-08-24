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

Vue.use(VueFlashMessage);
Vue.use(VTooltip);


const app = new Vue({
    el: '#app',
    components: {
        'ranking-user': RankingUser,
        'progress-bar': ProgressBar,
        'partner-link': PartnerLink,
    }
});

window.app = app;
