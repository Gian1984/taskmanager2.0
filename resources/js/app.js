require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import routes from './routes';
import Vuetify from "./plugins/vuetify"

Vue.component('home', require('./components/Home').default);

Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    vuetify: Vuetify,
});