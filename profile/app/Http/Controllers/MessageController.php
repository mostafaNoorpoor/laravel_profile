<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;

class MessageController extends Controller
{
    public function getUserData($id){
        $user = new User ;
        if($user::where('id', $id)->exists()){
            $userProfile = $user::where('id', $id)->get();
            return response()->json([ "message" => $userProfile ,  "success"=> 1  ], 200);
        } else {
            return response()->json([ "message" => "Student not found" , "success"=> 2  ], 404);
        }
    }
    public function logIn(Request $request){
        $user = new User ;
        $userProfile = $user::where('password', $request->email )->get();
        if ($userProfile['password'] == Hash::make($request->password)){
            return response()->json([ "message" => $userProfile , "success"=> 1  ], 200);
        } else {
            return response()->json([ "message" => "userName or password was incorrect" , "success"=> 2  ], 404);
        }
    }
    public function registerNewUser(Request $request){
        $date = date('Y-m-d H:i:s');
        $current_timestamp = Carbon::now()->timestamp; 
        $newUser = new User ;
        $newUser ->name             = '"'.$request->name.'"' ;
        $newUser ->email            = '"'.$request->email.'"';
        $newUser ->email_verified_at= '"'.$current_timestamp.'"';
        $newUser ->password         = '"'.Hash::make($request->password).'"' ;
        $newUser ->remember_token   = '"'.Str::random(60).'"' ;
        $newUser ->created_at       = '"'.$current_timestamp.'"' ;
        $newUser ->updated_at       = '"'.$current_timestamp.'"';
        $newUser->save();

       if ($newUser){
            return response()->json([ "data" => "registered successFully" ], 201);
        } else {
            return response()->json([ "data" => "query failed" ], 404);
        }
    }
    public function updateUser(Request $request){
        $user = new User ;
        if($user::where('id', $request->id)->exists()){
            $toUpdateProfile = $user::find($request->id); 
            $toUpdateProfile ->name = $request->name ;
            $toUpdateProfile->save();
            if ($toUpdateProfile){
                return response()->json([ "data" => "update successFully" , "success"=> 1 ], 200);
            } else {
                return response()->json([ "data" => "query failed" ], 404);
            }
        } else {
            return response()->json([ "message" => "Student not found" ], 404);
        }
    }
}
