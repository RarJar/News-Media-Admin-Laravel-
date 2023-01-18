<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\Post;
use App\Models\Category;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //Post List Page
    public function postListPage(){
        $Key = request('SearchKey');

        $posts = Post::select('posts.*','categories.title as categoryTitle')
                ->leftJoin('categories','posts.category_id','categories.id')
                ->when($Key,function($post){
                    $Key = request('SearchKey');
                    $post->where('posts.title','like','%' .$Key. '%');
                })
                ->orderBy('posts.id','desc')
                ->paginate(5);

        $posts->appends(request()->query());

        $categories = Category::orderBy('id','desc')->get();
        return view('Admin.post.postListPage',compact('posts','categories'));
    }

    // Post Create
    public function postCreate(Request $request){
        $this->postCreateValidation($request);
        $data = $this->postCreate_UpdateData($request);

        if($request->file('postImage')){
            $imageName = uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->move(public_path() . '/postImage',$imageName);

            $data['image'] = $imageName;
            Post::create($data);
        }

        return back();
    }

    // Post Update Page
    public function postUpdatePage($postId){
        $data = Post::select('posts.*','categories.id as categoryId')
                      ->leftJoin('categories','posts.category_id','categories.id')
                      ->where('posts.id',$postId)->first();

        $categories = Category::orderBy('id','desc')->get();

        return view('Admin.post.postUpdatePage',compact('data','categories'));
    }

    // Post Update
    public function postUpdate(Request $request){

        $this->postUpdateValidation($request);
        $data = $this->postCreate_UpdateData($request);

        if($request->file('postImage')){
            // Delete Old Image from Project
            $oldImageName = Post::select('image')->where('id',$request->postId)->first()->toArray();
            $oldImageName = $oldImageName['image'];
            if($oldImageName != null){
                File::delete(public_path().'/postImage/'.$oldImageName);
            }

            // Update New Image
            $imageName = uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->move(public_path() . '/postImage',$imageName);
            $data['image'] = $imageName;
        }

        Post::where('id',$request->postId)->update($data);

        return redirect()->route('post#postListPage');
    }

    // Post Delete
    public function postDelete($postId){
        // Image Delete in Project
        $imageName = Post::select('image')->where('id',$postId)->first()->toArray();
        $imageName = $imageName['image'];
        File::delete(public_path().'/postImage/'.$imageName);

        // Delete in database
        Post::where('id',$postId)->delete();
        return back();
    }

    //Trend Post Page
    public function trendPostPage(){
        $Key = request('SearchKey');

        $posts = Post::select('posts.*','action_logs.user_id as actionUserID','action_logs.post_id as actionPostID','categories.title as categoryTitle',DB::raw('COUNT(action_logs.post_id) as post_count'))
                ->leftJoin('action_logs','posts.id','action_logs.post_id')
                ->leftJoin('categories','posts.category_id','categories.id')
                ->groupBy('action_logs.post_id')
                ->when($Key,function($post){
                    $Key = request('SearchKey');
                    $post->where('posts.title','like','%' .$Key. '%');
                })
                ->orderBy('post_count','desc')
                ->paginate(5);

        $posts->appends(request()->query());

        $categories = Category::orderBy('id','desc')->get();
        return view('Admin.post.trendPostPage',compact('posts','categories'));
    }

    // Post Create Validation
    private function postCreateValidation($request){
        Validator::make($request->all(),[
            'postImage' => 'required|mimes:png,jpg,jpeg,wepb',
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategory' => 'required'
        ])->validate();
    }

    // Post Create Data
    private function postCreate_UpdateData($request){
        return[
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory
        ];
    }

     // Post Update Validation
     private function postUpdateValidation($request){
        Validator::make($request->all(),[
            'postImage' => 'mimes:png,jpg,jpeg,wepb',
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategory' => 'required'
        ])->validate();
    }
}
