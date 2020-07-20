<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus>

                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input v-model="password" id="password" type="password" class="form-control" name="password" required autocomplete="current-password">

                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            login() {
                this.$store.dispatch('authenticate')
                    .then(response => {
                        axios.post('/login', {
                            email: this.email,
                            password: this.password
                        })
                            .then(response => {
                                this.$store.commit('isLoggedIn', true);
                                this.$store.commit('userData', response.data);
                                this.$router.push('settings');
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>
