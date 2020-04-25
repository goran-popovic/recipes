import store from '../store'

export default async (to, from, next) => {
    console.log('before');
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to home page.
        console.log('before');
        console.log(store.getters.isLoggedIn);
        if (!store.getters.isLoggedIn) {
            next({
                path: '/'
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
}
