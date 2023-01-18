<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GetProfileController extends Controller
{
        // Get My ProfileData
        public function getMyProfileData(Request $request){
            $user = User::where('id',$request->userId)->first();

            return response()->json([
                'user' => $user
            ]);
        }
        // profile Update with token
        public function profileUpdate(Request $request){
            $this->profileUpdateValidation($request);

            User::where('id',$request->userId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'gender' => $request->gender
            ]);

            return response()->json([
                'status' => 'success'
            ]);
        }
        // change Password
        public function changePassword(Request $request){
            $this->chagnePassValidation($request);

            // Check Old Password
            $DB_oldPassword = User::select('password')->where('id',$request->userId)->first();
            if(Hash::check($request->oldPass, $DB_oldPassword->password)){
                 User::where('id',$request->userId)
                        ->update([
                            'password'=>Hash::make($request->newPass)
                        ]);

                return response()->json([
                    'status'=>'success'
                ]);

            }else{
                return response()->json([
                    'status'=>'notSame'
                ]);
            }
        }

          // Profile Update Validation
          private function profileUpdateValidation($request){
            Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'gender' => 'required'
            ])->validate();
        }

        // Change Password Validation
        private function chagnePassValidation($request){
            Validator::make($request->all(),[
                'oldPass' => 'required',
                'newPass' => 'required',
                'comfirm' => 'required|same:newPass'
            ])->validate();
        }

        // Change password Data
        private function chagnePassData($request){
            return[
                'title' => $request->postTitle
            ];
        }
}
