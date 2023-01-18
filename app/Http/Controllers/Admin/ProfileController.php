<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use File;

class ProfileController extends Controller
{
    //Profile Page
    public function profilePage(){
        return view('Admin.profile.profilePage');
    }
    //Update Profile
    public function updateProfile(Request $request){
        $this->updateProfileValidation($request);

        $data = $this->updateProfileData($request);

        if($request->file('userImage')){

            $oldImageName = User::select('image')->where('id',Auth::user()->id)->first()->toArray();
            $oldImageName = $oldImageName['image'];

            if($oldImageName != null){
                File::delete(public_path().'/profileImage/'.$oldImageName);
            }

            $imageName = uniqid() . $request->file('userImage')->getClientOriginalName();
            $request->file('userImage')->move(public_path() . '/profileImage',$imageName);

            $data['image'] = $imageName;

            User::where('id',Auth::user()->id)->update($data);
        }else{
            User::where('id',Auth::user()->id)->update([
                'name' => $request->userName,
                'email' => $request->userEmail,
                'address' => $request->userAddress,
                'gender' => $request->gender
            ]);
        }

        return back();
    }
     //Admin List Page
     public function adminListPage(){
        $Key = request('SearchKey');
        $admins = User::when($Key,function($admin){
            $Key = request('SearchKey');
            $admin->where('name','like','%' .$Key. '%');
        })
        ->where('role','admin')
        ->paginate(3);

        $admins->appends(request()->query());

        return view('Admin.profile.adminListPage',compact('admins'));
    }
    //Delete Admin
    public function deleteAdmin($id){
        // Image Delete in Project
        $imageName = User::select('image')->where('id',$id)->first()->toArray();
        $imageName = $imageName['image'];
        File::delete(public_path().'/profileImage/'.$imageName);

        // Delete in database
        User::where('id',$id)->delete();
        return back();
    }

    // userList Page
    public function userListPage(){
        $Key = request('SearchKey');
        $users = User::when($Key,function($user){
            $Key = request('SearchKey');
            $user->where('name','like','%' .$Key. '%');
        })
        ->where('role','user')
        ->paginate(3);

        $users->appends(request()->query());

        return view('Admin.profile.userListPage',compact('users'));
    }

    //Change Password Page
    public function changePasswordPage(){
        return view('Admin.profile.changePasswordPage');
    }
    // Change Password
    public function changePassword(Request $request){
        $this->changePasswordValidation($request);
        $data = $this->updatePassword($request);

        $userOldPassword = $request->oldPassword;
        $DBOldPassword = User::select('password')->where('id',Auth::user()->id)->first()->toArray();
        $DBOldPassword = $DBOldPassword['password'];

        if(Hash::check($userOldPassword, $DBOldPassword)){
            User::select('password')->where('id',Auth::user()->id)->update($data);
            return redirect()->route('#loginPage');
        }else{
            return back()->with('message','The old password does not match');
        }
    }
    //Delete My Account
    public function deleteAccount(){
        // Profile Image Delete in Project
        $imageName = User::select('image')->where('id', Auth::user()->id)->first();
        $imageName = $imageName->image;
        File::delete(public_path().'/profileImage/'.$imageName);

        // Account Delete
        User::where('id',Auth::user()->id)->delete();
        return redirect()->route('#loginPage');
    }
    // Update Profile Validation
    private function updateProfileValidation($request){
        Validator::make($request->all(),[
            'userImage' => 'mimes:jpeg,png,wepb,jpg',
            'userName' => 'required|max:30',
            'userEmail' => 'required',
            'userAddress' => 'required',
            'gender' => 'required'
        ],[
            'userName.required' => 'The user name field is required.'
        ])->validate();
    }

    //Update Profile Data
    private function updateProfileData($request){
        return[
            'image' => $request->userImage,
            'name' => $request->userName,
            'email' => $request->userEmail,
            'address' => $request->userAddress,
            'gender' => $request->gender
        ];
    }
    // Change Password Validation
    private function changePasswordValidation($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword',
        ])->validate();
    }
    // Update Password
    private function updatePassword($request){
        return[
            'password' => Hash::make($request->newPassword)
        ];
    }
}
