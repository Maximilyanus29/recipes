<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class importDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '6G');
        $rows = DB::table("recipe_temp")->get();

        $catsOfDb = DB::table("category")->get();
        $catsHases = [];

        foreach ($catsOfDb as $value){
            $catsHases[$value->name] = $value->id;

        }



// [1 => 'Taylor', 2 => 'Abigail'];
        $ingOfDb = DB::table("ingredient")->get();

        $ingHases = [];

        foreach ($ingOfDb as $value){
            $ingHases[$value->name] = $value->id;
        }





        foreach ($rows as $row){
            $categories = json_decode($row->categories, true);
            $ingredients = json_decode($row->ingredients, true);

            unset($categories[0]);

            $id = DB::table('recipe')->insertGetId([
                'name' => $row->h1,
                'slug' => Str::slug($row->h1, '-'),
                'description' => '',
                'ccal' => $row->ccal,
                'fat' => $row->fat,
                'protein' => $row->protein,
                'carbohydrates' => $row->uglevody,
                'portion' => $row->portion,
                'cooking_time' => $row->time,
                'link_to_origin' => $row->link,
                'instruction' => $row->instruction,
            ]);






            $rec_to_cat = [];
            $rec_to_ingr = [];



//
            foreach ($categories as $category){
                if (isset($catsHases[trim($category)])){
                    $catId = $catsHases[trim($category)];
                    $rec_to_cat[] = ['recipe_id' => $id, 'category_id' => $catId];
                }
            }


            DB::table('recipes_to_category')->insert($rec_to_cat);


            foreach ($ingredients as $category){
                $name = trim($category['title']);
                if (isset($ingHases[$name])){
                    $catId = $ingHases[$name];
                    $rec_to_ingr[] = ['recipe_id' => $id, 'ingredient_id' => $catId, 'value' => $category['value']];
                }
            }

            DB::table('recipes_to_ingredient')->insert($rec_to_ingr);

        }





//        foreach (array_chunk($rec_to_ingr,65000,true) as $chunk){
//
//
//
//        }


        var_dump(123);die;


    }
}
