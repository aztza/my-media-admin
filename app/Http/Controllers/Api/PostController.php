<?php

namespace App\Http\Controllers\Api;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function getAllPost(){
        $data = Posts::get();

        return response()->json([
            "post" => $data
        ]);
    }

    public function searchPost(Request $request){
        $key = $request->key;
        $response = Posts::where("title","like","%".$key."%")->get();

        return response()->json([
            "search" => $response
        ]);
    }

    public function postDetails(Request $request){
        $post = Posts::where("post_id", $request->id)->first();
        return response()->json([
            "postData" => $post
        ]);
    }
}
