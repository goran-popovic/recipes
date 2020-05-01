<template>
    <div id="app">
        <Header/>
        <router-view/>
    </div>
</template>

<script>
    export default {
        name: "app",
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
