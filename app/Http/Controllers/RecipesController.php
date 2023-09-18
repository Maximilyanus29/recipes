<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RecipesController extends Controller
{
    const LIMIT = 50;

    /**
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $models = DB::table("recipe")
            ->select("recipe.*")
            ->limit(self::LIMIT);

//для фильтров по лактозе и тд.
        $models1 = clone $models;

        $models1
            ->join("recipes_to_ingredient", "recipes_to_ingredient.recipe_id", "=", "recipe.id")
            ->join("ingredient", "ingredient.id", "=", "recipes_to_ingredient.ingredient_id")
            ->groupBy("recipe.id");

//для фильтров по лактозе и тд. end


        $params = $request->toArray();
        $filters = [];

        if (isset($params['filters'])){
            $filters = $params['filters'];
            Session::put('filters', $filters);
        }

        if (!empty($filters)){
            if (isset($filters['category'])){
                $models
                    ->join("recipes_to_category", "recipes_to_category.recipe_id", "=", "recipe.id")
                    ->join("recipes_to_ingredient", "recipes_to_ingredient.recipe_id", "=", "recipe.id")
                    ->where("category_id", $filters['category']);
            }

            if (isset($filters['ingredients'])){
                $models->where("ingredient_id", $filters['ingredients']);
            }


            {
                if (isset($filters['no_lactose'])) {
                    $models1->where("ingredient.contain_lactose", true);
                }

                if (isset($filters['no_gluten'])) {
                    $models1->where("ingredient.contain_gluten", true);
                }

                if (isset($filters['no_fry'])) {
                    $models1->where("ingredient.fry", true);
                }

                if (isset($filters['no_fat'])) {
                    $models1->where("ingredient.fat", true);
                }

                if (isset($filters['no_sugar'])) {
                    $models1->where("ingredient.contain_sugar", true);
                }
            }
//            if (isset($filters['healthy_eating'])){
//                $models1->where("ingredient.healthy_eating", false);
//            }
//
//            if (isset($filters['can_be_replaced_with_lactose_free'])){
//                $models1->where("ingredient.can_be_replaced_with_lactose_free", false);
//            }

            $ids = array_map(function ($el){
                return $el->id;
            }, $models1->get()->toArray());

            $models->whereNotIn("recipe.id", $ids);
        }

        return view('main', ['models' => $models->get()]);
    }

    /**
     * @param $slug
     * @return View
     */
    public function show($slug): View
    {
        $collection = DB::table("recipe")
            ->where("slug", "=", $slug)
            ->limit(1)->get();

        $model = $collection->getIterator()->current();

        $ingredients = DB::table("recipes_to_ingredient")
            ->join("ingredient", "ingredient.id", "=", "recipes_to_ingredient.ingredient_id")
            ->where("recipe_id", "=", $model->id)->get();

        return view('card', ['model'=>$model, 'ingredients' => $ingredients]);
    }

    /**
     * @return RedirectResponse
     */
    public function resetFilters(): RedirectResponse
    {
        // TODO по хорошему надо jsом чистить фильтры
        Session::forget('filters');
        return back()->withInput();
        return redirect()->action('RecipesController@index');
    }



    /**
     *
     * @param Request $request
     * @return View
     */
    public function gen(Request $request): View
    {
        $models = DB::table("recipe")
//            ->select("category.name")
            ->select(["recipe.*", 'category.id as cid'])
            ->join("recipes_to_category", "recipes_to_category.recipe_id", "=", "recipe.id")
            ->join("category", "category.id", "=", "recipes_to_category.category_id")
//            ->groupBy('category.name, recipe.*'
;

        $cc = [];


        foreach ($models->get() as $mode){
            $cc[$mode->cid][] = $mode;
        }

        $data = [
            $cc[1][rand(0, count($cc[1])-1)],
            $cc[32][rand(0, count($cc[32])-1)],
            $cc[8][rand(0, count($cc[8])-1)],
            $cc[20][rand(0, count($cc[20])-1)],
        ];



        return view('main', ['models' => $data]);



        $recGrByCat = [

        ];







//для фильтров по лактозе и тд.
        $models1 = clone $models;

        $models1
            ->join("recipes_to_ingredient", "recipes_to_ingredient.recipe_id", "=", "recipe.id")
            ->join("ingredient", "ingredient.id", "=", "recipes_to_ingredient.ingredient_id")
            ->groupBy("recipe.id");

//для фильтров по лактозе и тд. end


        $params = $request->toArray();
        $filters = [];

        if (isset($params['filters'])){
            $filters = $params['filters'];
            Session::put('filters', $filters);
        }
//        var_dump($filters);die;

        if (!empty($filters)){
            if (isset($filters['category'])){
                $models
                    ->join("recipes_to_category", "recipes_to_category.recipe_id", "=", "recipe.id")
                    ->join("recipes_to_ingredient", "recipes_to_ingredient.recipe_id", "=", "recipe.id")
                    ->where("category_id", $filters['category']);
            }

            if (isset($filters['ingredients'])){
                $models->where("ingredient_id", $filters['ingredients']);
            }


            {
                if (isset($filters['no_lactose'])) {
                    $models1->where("ingredient.contain_lactose", true);
                }

                if (isset($filters['no_gluten'])) {
                    $models1->where("ingredient.contain_gluten", true);
                }

                if (isset($filters['no_fry'])) {
                    $models1->where("ingredient.fry", true);
                }

                if (isset($filters['no_fat'])) {
                    $models1->where("ingredient.fat", true);
                }

                if (isset($filters['no_sugar'])) {
                    $models1->where("ingredient.contain_sugar", true);
                }
            }
//            if (isset($filters['healthy_eating'])){
//                $models1->where("ingredient.healthy_eating", false);
//            }
//
//            if (isset($filters['can_be_replaced_with_lactose_free'])){
//                $models1->where("ingredient.can_be_replaced_with_lactose_free", false);
//            }

            $ids = array_map(function ($el){
                return $el->id;
            }, $models1->get()->toArray());

            $models->whereNotIn("recipe.id", $ids);
        }

        return view('main', ['models' => $models->get()]);
    }



    private function isJoined($query, $table){
        $joins = collect($query->getQuery()->joins);
        return $joins->pluck('table')->contains($table);
    }
}
