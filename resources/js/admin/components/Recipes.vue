<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <h3 class="mb-2">Create new recipe</h3>
                <form id="recipe-form" class="mb" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="mb-1">Recipe title</label>
                        <input type="text" class="form-control mb-2">
                        <label class="mb-1">Add a description</label>
                        <textarea class="form-control mb-2" rows="6" cols="50"></textarea>
                        <label class="mb-1">Add ingredients</label>
                        <textarea class="form-control mb-2" rows="6" cols="50"></textarea>
                        <label class="mb-1">Choose a category</label>
                        <select class="form-control mb-2">
<!--                            <option>-->
<!--&lt;!&ndash;                                {{ category.name }}&ndash;&gt;-->
<!--                            </option>-->
                        </select>
                        <label class="mb-1">Upload Images</label>
                        <input class="mb-2" type="file" id="cover_image" ref="cover_image" @change=""/>
                        <input type="hidden" class="form-control mb">
                        <input type="hidden" class="form-control mb">
                        <input type="hidden" class="form-control mb">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
<!--                <h5 class="mb-2">Create new recipe</h5>-->
<!--                <p>1. Select a category</p>-->
<!--                <select id="industry" class="mb-2 selectpicker">-->
<!--                    @foreach($industries as $industry)-->
<!--                        <option value="{{ $industry->id }}">{{ $industry->name }}</option>-->
<!--                    @endforeach-->
<!--                </select>-->
<!--                <p class="mb-1">2. Save the template to database</p>-->
<!--                <button id="save-db" class="btn btn-primary">Save to DB</button>-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created: function () {
            console.log('gelo');
        }
    }
</script>
