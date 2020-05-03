<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Category as CategoryResource;
use App\Category;

class AdminController extends Controller
{
    public function recipeMaker()
    {
        $categories = CategoryResource::collection(Category::all())->toJson();
        $adminRoute = config('app.admin_route');

        return view('admin.recipe_maker', compact('categories', 'adminRoute'));
    }

}
