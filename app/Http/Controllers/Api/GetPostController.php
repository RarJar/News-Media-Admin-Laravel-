<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Reaction;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetPostController extends Controller
{
    //Get All Post
    public function getAllPost(){
        $posts = Post::orderBy('id','desc')->get();
        return response()->json([
            'post' => $posts
        ]);
    }
    // Search Post
    public function searchPost(Request $request){
        // logger($request->key);
        $posts = Post::where('title','like','%' .$request->key. '%')->orderBy('id','desc')->get();
        return response()->json([
            'searchData' => $posts
        ]);
    }
    // Post Details
    public function postDetails(Request $request){
        $post = Post::where('posts.id',$request->postId)
            ->select('posts.*','categories.title as category_title')
            ->leftJoin('categories','posts.category_id','categories.id')
            ->first();
        return response()->json([
            'post' => $post
        ]);
    }

    // Post ViewCounts
    public function postViewCounts(Request $request){
        ActionLog::create([
            'user_id' => $request->userId,
            'post_id' => $request->postId
        ]);

        $viewCount = ActionLog::where('post_id',$request->postId)->get();

        return response()->json([
            'views' => $viewCount
        ]);
    }

    // post Comments
    public function postComment(Request $request){
        Reaction::create([
            'user_id' => $request->userId,
            'post_id' => $request->postId,
            'comment'=> $request->comment
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    // load Comments
    public function loadComments(Request $request){
        $comments = Reaction::select('reactions.*','users.name as userName','users.image as userImage')
                            ->leftJoin('users','reactions.user_id','users.id')
                            ->where('reactions.post_id',$request->postId)
                            ->orderBy('reactions.id','desc')
                            ->get();

        return response()->json([
            'comments' => $comments
        ]);
    }

    // comment Delete
    public function commentDelete(Request $request){
        Reaction::where('id',$request->commentId)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
