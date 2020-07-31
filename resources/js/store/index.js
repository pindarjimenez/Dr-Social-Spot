import Vue from 'vue'
import Vuex from 'vuex'

import Posts from './modules/posts';
import Users from './modules/users';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Posts,
        Users
    },
})
