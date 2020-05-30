<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Recipe;
use App\RecipeImage;
use App\Http\Resources\Recipe as RecipeResource;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get recipes
        $recipes = Recipe::orderBy('created_at', 'desc')->with(['category', 'images'])->paginate(5);

        // return collection of recipes as a resource
        return RecipeResource::collection($recipes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipe $request)
    {
        $validated = $request->validated();

        $title = $validated['title'];
        $description = $validated['description'];
        $ingredients = $validated['ingredients'];
        $categoryId = $validated['category_id'];
        $images = $validated['images'];

        $recipeData = [
            'title'       => $title,
            'description' => $description,
            'ingredients' => $ingredients,
            'category_id' => $categoryId,
            'user_id'     => auth()->user()->id,
        ];

        $recipe = Recipe::create(
            $recipeData
        );

        if ($recipe->exists) {
            // Handle File Upload
            if ($request->hasFile('images')) {
                foreach ($images as $image) {
                    $nameWithExtension = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $fileName = pathinfo($nameWithExtension, PATHINFO_FILENAME);

                    $folder = 'public/';
                    $fileNameToStore = 'recipe-images/' . $fileName . '.' . $extension;

                    $fileMoved = Storage::disk('local')->put($folder . $fileNameToStore, file_get_contents($image));

                    if($fileMoved) {
                        $recipeImageData = [
                            'image_path' => $fileNameToStore,
                            'recipe_id'  => $recipe->id,
                        ];

                        $recipeImage = RecipeImage::create(
                            $recipeImageData
                        );
                    }
                }
            }

            return new RecipeResource($recipe);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get recipe
        $recipe = Recipe::with(['category', 'images'])->findOrFail($id);

        // Return single recipe as a resource
        return new RecipeResource($recipe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
