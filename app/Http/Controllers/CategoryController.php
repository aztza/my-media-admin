<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index() {
        $category = Categories::get();
        return view("admin.category.index",compact("category"));
    }

    public function createCategory(Request $request){
        $validation = $this->categoryValidationCheck($request);
        if ($validation->fails()){
            return back()->withErrors($validation)->withInput();
        }

        $createCategory = $this->getCategoryData($request);
        Categories::create($createCategory);
        return back();
    }

    //delete function
    public function deleteCategory($id){
        Categories::where("category_id",$id)->delete();
        return back()->with(["delete success" => "Category Deleted"]);
    }

    public function searchCategory(Request $request){
        $category = Categories::orWhere("title","LIKE","%".$request->cateogrySearchKey."%")
                                  ->orWhere("description","LIKE","%".$request->cateogrySearchKey."%")
                                  ->get();

        return view("admin.category.index",compact("category"));
    }

    public function updatePageCategory($id){
        $category = Categories::get();
        $chooseData = Categories::where("category_id",$id)->first();
        return view("admin.category.edit",compact("chooseData","category"));
    }

    public function updateCategory($id,Request $request){
        $validation = $this->categoryValidationCheck($request);
        if ($validation->fails()){
            return back()->withErrors($validation)->withInput();
        }
        $updateCategory = $this->getCategoryData($request);
        Categories::where("category_id",$id)->update($updateCategory);
        return redirect()->route("admin#category");
    }

    private function categoryValidationCheck($request){
        return Validator::make($request->all(),[
            "categoryName" => "required",
            "categoryDescription" => "required",
        ]);
    }

    private function getCategoryData($request){
        return [
            "title" => $request->categoryName,
            "description" => $request->categoryDescription
        ];
    }
}
