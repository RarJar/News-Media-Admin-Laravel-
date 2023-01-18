<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class GetAuthController extends Controller
{
    // Login with token
    public function userLogin(Request $request){
        $user = User::where('email',$request->email)->first();

        if(isset($user)){
            if(($user->email == $request->email) && Hash::check($request->password,$user->password) && $user->role == 'user'){
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ]);

            }else{
                return response()->json([
                    'user' => null,
                    'token' => null
                ]);
            }
        }else{
            return response()->json([
                'user' => null,
                'token' => null
            ]);
        }
    }

    // Register with token
    public function userRegister(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'password' => Hash::make($request->password)
        ]);

        $user = User::where('email',$request->email)->first();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken
        ]);
    }
}
