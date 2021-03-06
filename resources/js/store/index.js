import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import Cookies from 'js-cookie';

 import * as authModule from './modules/auth';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        authModule: authModule
    },
    plugins: [createPersistedState({
        storage: {
            getItem: key => Cookies.get(key),
            setItem: (key, value) => Cookies.set(key, value, { domain: `.${window.location.hostname}`, expires: 375 , secure: false }),
            removeItem: key => Cookies.remove(key)
        }
    })],
})
