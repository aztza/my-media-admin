<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function index(){
        $adminList = User::select("id","name","email","phone","address","gender")->get();
        return view("admin.list.index",compact('adminList'));
    }

    public function deleteAdminAccount($id){
        if($id == Auth::user()->id){
            return back()->with(["already login" => "you can't delete the currently login account"]);
        }else{
            User::where("id",$id)->delete();
            return back();
        }
    }

    public function adminListSearch(Request $request){
        $adminList = User::orWhere("name","LIKE","%".$request->adminSearchKey."%")
                    ->orWhere("email","LIKE","%".$request->adminSearchKey."%")
                    ->orWhere("address","LIKE","%".$request->adminSearchKey."%")
                    ->orWhere("phone","LIKE","%".$request->adminSearchKey."%")
                    ->orWhere("gender","LIKE","%".$request->adminSearchKey."%")
                    ->get();

                    return view("admin.list.index",compact('adminList'));

    }
}
