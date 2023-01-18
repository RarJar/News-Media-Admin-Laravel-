<?php

namespace App\Http\Controllers\Admin;

use App\Models\userFeedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFeedbackController extends Controller
{
    //user Feedback Page
    public function userFeedbackPage(){

        $Key = request('SearchKey');

        $feedbacks = userFeedback::when($Key,function($post){
                                        $Key = request('SearchKey');
                                        $post->where('name','like','%' .$Key. '%');
                                    })
                                    ->orderBy('id','desc')
                                    ->paginate(5);

        $feedbacks->appends(request()->query());

        return view('Admin.other.userFeedbackPage',compact('feedbacks'));
    }
    // feedback Delete
    public function feedbackDelete($id){
        userFeedback::where('id',$id)->delete();
        return back();
    }
}
