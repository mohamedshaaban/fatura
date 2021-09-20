import Login  from "./components/Login";
import Register  from "./components/Register";
import Home  from "./components/Home";

import Router from 'vue-router'
import Vue from "vue";

// const routes = new Router({
export default {
    mode: 'history',

    linkActiveClass: 'link-active',

    routes: [

        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        }
    ]
}


