<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>

                    <div class="card-body">
                        Home
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created: function () {
            console.log(this.$store.getters.isLoggedIn);
            console.log(this.$store.state.isLoggedIn);
            console.log(this.$store);
        }
    }
</script>
