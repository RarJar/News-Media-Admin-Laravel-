<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetCategoryController extends Controller
{
    //Get All Category
    public function getAllCategory(){
        $categories = Category::orderBy('id','desc')->get();
        return response()->json([
            'category' => $categories
        ]);
    }

    // SearchPost By Category
    public function searchPostByCategory(Request $request){
        // logger($request->all());
        if($request->key == 'all'){
            $posts = Post::orderBy('id','desc')->get();
        }else{
            $posts = Post::where('category_id',$request->key)->orderBy('id','desc')->get();
        }

        return response()->json([
            'post' => $posts
        ]);
    }
}
