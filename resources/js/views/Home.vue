<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5" v-for="recipe in recipes">
                    <div class="card-header">{{ recipe.title }}</div>

                    <div class="card-body">
                        <template class="card mb-5" v-for="image in recipe.images">
                            <img :src="'/storage/' + image.image_path" alt="recipe image" style="width: 100px">
                        </template>
                        <div v-html="recipe.description"></div>
                        <div v-html="recipe.ingredients"></div>
                        <p class="card-text">{{ recipe.created_at | moment("D.M.YYYY") }}</p>
                        <p class="card-text">{{ recipe.category.name }}</p>
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
                recipes: [],
            }
        },
        created: function () {
            console.log(this.$store.getters.isLoggedIn);
            console.log(this.$store.state.isLoggedIn);
            console.log(this.$store);
            this.getRecipes();
        },
        methods: {
            getRecipes() {
                axios.get('/api/recipes')
                    .then(response => {
                        console.log(response);
                        this.recipes = response.data.data;
                        // this.$store.commit('isLoggedIn', true);
                        // this.$store.commit('userData', response.data);
                        // this.$router.push('settings');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>
