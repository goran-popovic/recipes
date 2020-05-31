<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'ingredients', 'category_id', 'user_id'
    ];

    /**
     * Get the images for the recipe.
     */
    public function images()
    {
        return $this->hasMany('App\RecipeImage');
    }

    /**
     * Get the user that owns the recipe.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the category that the recipe belongs to.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    // Determine whether a recipe has been marked as favorite by a user.
    public function favorited()
    {
        $user = auth()->user();

        if($user) {
            return (bool)Favorite::where('user_id', $user->id)
                ->where('recipe_id', $this->id)
                ->first();
        }

        return false;
    }
}
