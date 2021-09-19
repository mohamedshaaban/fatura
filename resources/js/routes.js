import Login  from "./components/Login";

import Router from 'vue-router'
import Vue from "vue";

// const routes = new Router({
export default {
    mode: 'history',

    linkActiveClass: 'link-active',

    routes: [

        {
            path: '/login',
            name: 'login',
            component: Login
        }
    ]
}

// router.beforeEach((to, from, next) => {
//
//     // use the language from the routing param or default language
//     let language = to.params.lang;
//     if (!language) {
//         language = 'en';
//     }
//
//     // set the current language for vuex-i18n. note that translation data
//     // for the language might need to be loaded first
//     Vue.i18n.set(language);
//     next();
//
// });

// export default routes
