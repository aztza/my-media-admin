<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\ActionLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    public function index(){
        $posts = ActionLogs::query()->select("action_logs.*","posts.*",DB::raw('COUNT(action_logs.post_id) as post_count'))
                ->leftJoin("posts","posts.post_id","action_logs.post_id")
                ->groupBy("action_logs.post_id")
                ->get();
        return view('admin.trend_post.index',compact("posts"));
    }

    public function trendPostDetail($id){
        $post = Posts::where("post_id",$id)->first();
        return view("admin.trend_post.detail",compact("post"));
    }
}
