require('./bootstrap');

window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue';

Vue.component('starship-game', require('./components/starshipsGame.vue').default);

Vue.use(BootstrapVue);
Vue.prototype.$http = window.axios;

const app = new Vue({
    el: '#app',
});
