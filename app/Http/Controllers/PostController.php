<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Posts;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        $category = Categories::get();
        $post = Posts::get();
        return view("admin.post.index",compact("category","post"));
    }

    public function updatePostPage($id){
        $postDetail = Posts::where("post_id",$id)->first();
        $category = Categories::get();
        $post = Posts::get();
        return view("admin.post.update",compact("postDetail","category","post"));
    }

    public function createPost(Request $request){
        $validation = $this->getPostValidator($request);
        if ($validation->fails()){
            return back()->withErrors($validation)->withInput();
        }

        if(!empty($request->postImage)){
            $file = $request->file("postImage");
            $fileName = uniqid()."_".$file->getClientOriginalName();
            $file->move(public_path()."/image",$fileName);
            $data = $this->getPostData($request,$fileName);
        }else{
            $data = $this->getPostData($request,null);
        }

        Posts::create($data);

        return back();
    }

    public function deletePost($id){
        $dbData = Posts::where("post_id",$id)->first();
        $dbImage = $dbData->image;
        Posts::where("post_id",$id)->delete();
        if(File::exists(public_path()."/image/".$dbImage)){
           File::delete(public_path()."/image/".$dbImage);
        }

        return back();
    }

    public function updatePost($id,Request $request){
        $validation = $this->getPostValidator($request);
        if ($validation->fails()){
            return back()->withErrors($validation)->withInput();
        }

        $data = $this->getPostUpdateData($request);

        if(isset($request->postImage)){
            $file = $request->file("postImage");
            $fileName = uniqid()."_".$file->getClientOriginalName();

            $db = Posts::where("post_id",$id)->first("image");
            $dbImage = $db->image;
            if(File::exists(public_path()."/image/".$dbImage)){
                File::delete(public_path()."/image/".$dbImage);
             }
            $file->move(public_path()."/image",$fileName);
            $data["image"] = $fileName;

            Posts::where("post_id",$id)->update($data);
            return redirect()->route("admin#post");
        }else{
            Posts::where("post_id",$id)->update($data);
            return redirect()->route("admin#post");
        }
    }

    private function getPostUpdateData($request){
        return [
            "title" => $request->postTitle,
            "description" => $request->postDescription,
            "category_id" =>  $request->postCategory,
            "updated_at" => Carbon::now()
        ];
    }

    private function getPostData($request,$fileName){
        return [
            "title" =>  $request->postTitle,
            "description" => $request->postDescription,
            "image" => $fileName,
            "category_id" => $request->postCategory,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
    }

    private function getPostValidator($request){
        return  Validator::make($request->all(),[
                "postTitle" => "required",
                "postDescription" => "required",
                "postCategory" => "required",
            ]);
    }
}
