import Vue from "vue";
import Vuex from "vuex";
import router from '../router'
import createPersistedState from "vuex-persistedstate";
import SecureLS from "secure-ls";
let ls = new SecureLS({ isCompression: false });

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        isLoggedIn: false,
        user: {}
    },
    getters: {
        isLoggedIn: state => {
            return state.isLoggedIn
        },
        userData: state => {
            return state.user
        }
    },
    mutations: {
        isLoggedIn (state, status) {
            state.isLoggedIn = status;
        },
        userData (state, userData) {
            state.user = userData;
        }
    },
    actions: {
        logout (context) {
            axios.post('/logout')
                .then(response => {
                    context.commit('isLoggedIn', false);
                    context.commit('userData', {});
                    if(router.currentRoute.path !== '/') {
                        router.push('/');
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        authenticate () {
            return axios.get('/sanctum/csrf-cookie');
        }
    },
    modules: {

    },
    plugins: [
        createPersistedState({
            storage: {
                getItem: (key) => ls.get(key),
                setItem: (key, value) => ls.set(key, value),
                removeItem: (key) => ls.remove(key),
            },
        }),
    ],
})
