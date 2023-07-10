<?php

namespace App\Http\Controllers\Api;

use App\Models\ActionLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogsController extends Controller
{
    public function viewCount(Request $request){
        $data = [
            "user_id" => $request->user_id,
            "post_id" => $request->post_id
        ];
        ActionLogs::create($data);
        $viewCount = ActionLogs::where("post_id",$request->post_id)->get();
        return response()->json([
            "result" => count($viewCount)
        ]);
    }
}
