import Vuetify from "vuetify";

require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import routes from "./routes";
import $ from 'jquery';
import axios from 'axios';

import App from './app.vue';

 Vue.use(VueRouter);
Vue.use(VueAxios, axios);

window.axios = require('axios');


Vue.use(Vuetify);



const lang = document.documentElement.lang.substr(0, 2);
// or however you determine your current app locale
const i18n = new VueInternationalization({
    fallbackLocale: 'en',
    locale: lang,
    messages: Locale
});

const app = new Vue({
    el: '#app',
    i18n,
    components: { App,Footer, Header },
    router: new VueRouter(routes),
});
