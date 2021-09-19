import axios from 'axios';

export const namespaced = true;

export const state = {
    accessToken: null,
};

export const mutations = {
    setAccessToken: (state, value) => {
        state.accessToken = value;
    },
};

export const getters = {
    isAuthenticated: (state) => {
        var now = new Date().getTime() / 1000;
        var expires_at = localStorage.getItem('user-token-expiry-at');

        if((localStorage.getItem('user-token') !== null)||( state.accessToken  !== null)){
            state.accessToken = state.accessToken  ? state.accessToken  : localStorage.getItem('user-token') ;

            return true;
        }
        return false;
        //return state.accessToken !== null;
    },
};

export const actions = {

    /**
     * register a user
     *
     * @param context {Object}
     * @param userData {Object} User userData
     * @param userData.email {string} User email
     * @param userData.password {string} User password
     * @param userData.role {string} User phone
     */
    registerUser(context, userData) {
        return axios.post('/api/v1/register', userData)
            .then((response) => {
                // retrieve access token
                const { access_token: accessToken } = response.data;

                // commit it
                context.commit('setAccessToken', accessToken);

                return Promise.resolve();
            })
            .catch((error) => Promise.reject(error.response));
    },

     /**
     * Login a user
     *
     * @param context {Object}
     * @param credentials {Object} User credentials
     * @param credentials.email {string} User email
     * @param credentials.password {string} User password
     */
    login(context, credentials) {
        return axios.post('/api/v1/login', credentials)
            .then((response) => {
                //check errors
                if(response.message)
                {
                    return response
                }else{
                    // retrieve access token
                    // commit it
                    state.accessToken =response.data.access_token;
                    context.commit('setAccessToken', response.data.access_token);
                    localStorage.setItem('user-token', response.data.access_token)
                    localStorage.setItem('user-token-expiry-at', response.data.expires_at)

                    return Promise.resolve();
                }

            })
            .catch((error) => Promise.reject(error.response));
    },

    logout(context) {
        context.commit('setAccessToken', null);
        localStorage.removeItem('user-token');
        state.accessToken = null;
        localStorage.removeItem('user-token-expiry-at');
        return Promise.resolve();
    },
};
