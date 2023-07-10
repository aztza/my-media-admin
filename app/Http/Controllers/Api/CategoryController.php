<?php

namespace App\Http\Controllers\Api;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getAllCategory(){
        $category = Categories::select('category_id','title','description')->get();

        return response()->json([
            'category' => $category
        ]);
    }

    public function searchCategory(Request $request){
        $responseData = Categories::select("posts.*")
                        ->join("posts","categories.category_id","posts.category_id")
                        ->where("categories.title","like","%".$request->key."%")
                        ->get();
        return response()->json([
            "result" => $responseData
        ]);
    }
}
