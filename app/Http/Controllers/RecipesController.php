<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    public function index()
    {
        return Recipe::paginate(20);
    }
    public function show(Recipe $recipe)
    {
        return $recipe;
    }
    public function store(Request $request)
    {
        $recipe = Recipe::create($request->all());
        return response()->json($recipe, 201);
    }
    public function update(Request $request, Recipe $recipe)
    {
        $recipe->update($request->all());
        return response()->json($recipe, 200);
    }
    public function delete(Recipe $recipe)
    {
        $recipe->delete();
        return response()->json(null, 204);
    }

}
