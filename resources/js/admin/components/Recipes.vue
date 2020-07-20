<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <h3 class="mb-2">Create new recipe</h3>
                <form @submit.prevent="addRecipe" id="recipe-form" class="mb" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="mb-1">Recipe title</label>
                        <input type="text" class="form-control mb-2" v-model="recipe.title">
                        <label class="mb-1">Add a description</label>
                        <textarea class="form-control mb-2" rows="6" cols="50" v-model="recipe.description"></textarea>
                        <label class="mb-1">Add ingredients</label>
                        <textarea class="form-control mb-2" rows="6" cols="50" v-model="recipe.ingredients"></textarea>
                        <label class="mb-1">Choose a category</label>
                        <select class="form-control mb-2" v-model="recipe.categoryId">
                            <option v-for="category in categories" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <label class="mb-1">Upload Images</label>
                        <input class="mb-2" type="file" id="images" ref="images" multiple="multiple" @change="handleFileUpload()"/>
                        <input type="hidden" class="form-control mb">
                        <input type="hidden" class="form-control mb">
                        <input type="hidden" class="form-control mb">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            categories: Array,
            adminRoute: String
        },
        data() {
            return {
                recipe: {
                    id: '',
                    title: '',
                    description: '',
                    ingredients: '',
                    categoryId: null,
                    images: []
                },
            }
        },
        created: function () {
        },
        methods: {
            handleFileUpload(){
                this.recipe.images = this.$refs.images.files;
            },
            addRecipe() {
                let formData = new FormData();
                formData.append('title', this.recipe.title);
                formData.append('description', this.recipe.description);
                formData.append('ingredients', this.recipe.ingredients);
                formData.append('category_id', this.recipe.categoryId);
                for(let i = 0; i < this.recipe.images.length; i++){
                    let image = this.recipe.images[i];
                    formData.append('images[' + i + ']', image);
                }

                axios.post('recipes/store', formData)
                    .then(response => {
                        this.recipe.title = '';
                        this.recipe.description = '';
                        this.recipe.ingredients = '';
                        this.recipe.images = '';
                        this.recipe.categoryId = '';
                        this.$refs.images.value = '';
                        toastr.success('Recipe Added');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>
