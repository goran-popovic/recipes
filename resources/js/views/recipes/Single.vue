<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
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
                recipe: {
                    id: '',
                    title: '',
                    description: '',
                    ingredients: '',
                    category: {},
                    images: [],
                    created_at: '',
                    updated_at: ''
                }
            }
        },
        created: function () {
            this.getRecipe();
        },
        methods: {
            getRecipe() {
                axios.get('/api/recipes/' + this.$route.params.id)
                    .then(response => {
                        console.log(response);
                        this.recipe = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>
