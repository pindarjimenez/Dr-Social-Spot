import Vuetify from 'vuetify';
import VeeValidate from 'vee-validate';

require('./bootstrap');

window.Vue = require('vue');
Vue.use(Vuetify);
Vue.use(VeeValidate);

Vue.component('login', require('./components/LoginForm.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
});