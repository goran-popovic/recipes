<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5">
        <div class="container">
            <router-link class="navbar-brand" to="/">Recipes</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <template v-if="!isLoggedIn">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/login">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/register">Register</router-link>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item">
                            <a @click.prevent="logout" href="#" class="nav-link">Logout</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ user.name }}
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Logout</a>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        computed: {
            isLoggedIn () {
                return this.$store.getters.isLoggedIn;
            },
            user () {
                return this.$store.getters.userData;
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout');
            }
        },
        created() {
        }
    }
</script>
