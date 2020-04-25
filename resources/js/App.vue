<template>
    <div id="app">
        <Header/>
        <router-view/>
    </div>
</template>

<script>
    import Header from './components/Header';

    export default {
        name: "app",
        components: {
            Header
        },
        created: function () {
            console.log(this.$store.getters.isLoggedIn);
            console.log(this.$store.state.isLoggedIn);
            console.log(this.$store);

            axios.interceptors.response.use((response) => {
                return response;
            }, (error) => {
                if(error.response.status === 401) {
                    this.$store.dispatch('logout');
                }

                return Promise.reject(error.message);
            });
        }
    }
</script>

<style>

</style>
