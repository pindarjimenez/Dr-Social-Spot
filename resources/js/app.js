import Vuetify from 'vuetify';
import VeeValidate from 'vee-validate';
import store from './store/index';

require('./bootstrap');

window.Vue = require('vue');
Vue.use(Vuetify);
Vue.use(VeeValidate);
Vue.use(require('vue-moment'));

Vue.component('header-navbar', require('./components/HeaderNavbar').default);
Vue.component('footer-layout', require('./components/FooterLayout').default);
Vue.component('news-feed', require('./components/NewsFeed').default);
Vue.component('profile', require('./components/Profile').default);
Vue.component('login', require('./components/LoginForm').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    store,
});