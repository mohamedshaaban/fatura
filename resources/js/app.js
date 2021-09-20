import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import store from './store';
import VueAxios from 'vue-axios';

import Layout from "./components/Layout";
import Login from "./components/Login";


window.axios = require('axios');


Vue.use(VueRouter)



// or however you determine your current app locale

let app = new Vue({
    el: '#app',
    store,
    components: {
        Layout
    },
    mounted: function(){

    },
    created () {


    },

    router: new VueRouter(routes)
});

axios.interceptors.request.use(
    (requestConfig) => {
        if (store.getters['authModule/isAuthenticated']) {
            // console.log('sending authorization');
            // console.log(store.state.authModule.accessToken);
            requestConfig.headers.Authorization = `Bearer ${store.state.authModule.accessToken}`;
        }else{
            console.log('No authorization');
        }

        // requestConfig.headers.xLocalization = this.$store.state.langModule.lang;

        return requestConfig;
    },
    (requestError) => Promise.reject(requestError),
);

axios.interceptors.response.use(
    response => response,
    (error) => {
        if (error.response.status === 401 ) {
            // Clear token and redirect
            store.commit('authModule/setAccessToken', null);
            // window.location.replace(`${window.location.origin}/login`);
        }
        return Promise.reject(error);
    },
);
