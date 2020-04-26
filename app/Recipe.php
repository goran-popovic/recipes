<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // Determine whether a recipe has been marked as favorite by a user.
    public function favorited()
    {
        $user = auth()->user();

        return (bool) Favorite::where('user_id', $user->id)
            ->where('recipe_id', $this->id)
            ->first();
    }
}
