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
            // store.commit('incrementBy', 8);
        },
        userData (state, userData) {
            state.user = userData;
        }
        // incrementBy (state, payload) {
        //     state.count += payload.amount
        //     store.commit('incrementBy', { amount: 29 });
        // }
        // methods: {
        //     increment () {
        //         this.$store.commit('increment')
        //     }
        // }
        // import { mapState, mapMutations } from 'vuex';
        // computed: mapState([
        //     'count'
        // ]),
        // methods: mapMutations([
        //     'increment',
        //     'incrementBy'
        // ])
        // doneTodos: state => {
        //     return state.todos.filter(todo => todo.done);
        // },
        // doneTodosCount: (state, getters) => {
        //     return getters.doneTodos.length
        // },
        // getTodoById: (state) => (id) => {
        //     return state.todos.find(todo => todo.id === id)
        // }
        // computed: {
        //     doneTodosCount () {
        //         return this.$store.getters.doneTodo
        //     }
        // }
        // console.log(store.getters.getTodoById(48))
        // actions: {
        //     increment (context) {
        //         context.commit('increment')
        //     }
        // }
        // methods: {
        //     increment () {
        //         this.$store.dispatch('incrementAsync');
        //             this.$store.dispatch('incrementAsync', payload);
        //     },
        //     decrement () {
        //         this.$store.commit('decrement');
        //     },
        // }

        // incrementAsync ({ commit }) {
        //     setTimeout(() => {
        //         commit('increment')
        //     }, 1000)
        // }
        // actionA ({ commit }) {
        //     return new Promise((resolve, reject) => {
        //         setTimeout(() => {
        //             commit('someMutation')
        //             resolve()
        //         }, 1000)
        //     })
        // }
        // testAction () {
        //     this.$store.dispatch('actionA').then(() => {
        //
        //     })
        // }
        // async actionD ({ dispatch, commit} ) {
        //     await dispatch('actionC')
        //     commit('gotOtherData', await getOtherData())
        // }
    },
    actions: {
        logout (context) {
            axios.post('/logout')
                .then(response => {
                    console.log(response);
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
    // plugins: [createPersistedState()],
    plugins: [
        createPersistedState({
            storage: {
                getItem: (key) => ls.get(key),
                setItem: (key, value) => ls.set(key, value),
                removeItem: (key) => ls.remove(key),
            },
        }),
    ],
    // plugins: [createPersistedState({
    //     paths: ['newCount']
    // })]
    // plugins: [createPersistedState({
    //     storage: window.sessionStorage,
    // })],
    // Use sessionStorage.clear(); when user logs out manually.
})
