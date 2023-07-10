<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $id = Auth::user()->id;

        $user = User::select('*')->where('id',$id)->first();
        return view('admin.profile.index',compact('user'));
    }

    public function updateAdminAccount(Request $request){
        $updateData = $this->updateAdminInfo($request);
        $validation = $this->adminValidation($request);
        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        User::where('id',Auth::user()->id)->update($updateData);
        return back()->with(["update successed" => "Admin Account is updated successfully"]);
    }

    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    public function changePassword(Request $request){
        $validation = $this->changePasswordValidationCheck($request);
        if ($validation->fails()){
            return back()->withErrors($validation)->withInput();
        }
        $user = User::where("id",Auth::user()->id)->first();
        $dbpassword = $user->password;
        $userOldPassword = $request->oldPass;
        $updateDb = [
            "password" => Hash::make($request->newPass)
        ];
        if(Hash::check($userOldPassword, $dbpassword)){
            User::where('id',Auth::user()->id)->update($updateDb);
            return redirect()->route("dashboard");
        }else{
            return back()->with(["fail" => "old password must be same with your current password"]);
        }
    }

    private function updateAdminInfo($request){
        return [
            "name" => $request->adminName,
            "email" => $request->adminEmail,
            "phone" => $request->adminPhone,
            "address" => $request->adminAddress,
            "gender" => $request->adminGender
        ];
    }

    private function adminValidation(Request $request){
        return Validator::make($request->all(), [
            "adminName" => 'required',
            "adminEmail" => 'required',
        ]);
    }

    private function changePasswordValidationCheck($request){
        $validationMessage = [
            'oldPass.required' => "Old Password must be filled",
            'newPass.required' => "New Password must be filled",
            'comfirmPass.required' => "Comfirm Password must be filled",
            'comfirmPass.same' => "The new password and comfirm password must be same!"
        ];
        return Validator::make($request->all(),[
            'oldPass' => 'required',
            'newPass' => 'required|min:8',
            'comfirmPass' => 'required|same:newPass|min:8'
        ],$validationMessage);
    }
}
