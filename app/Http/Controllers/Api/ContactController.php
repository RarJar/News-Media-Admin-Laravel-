<?php

namespace App\Http\Controllers\Api;

use App\Models\userFeedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //create Contact Message
    public function createContactMessage(Request $request){
        $this->createContactValidation($request);
        userFeedback::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }
    // Post Update Validation
    private function createContactValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ])->validate();
    }
}
