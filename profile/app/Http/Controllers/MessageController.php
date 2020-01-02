<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MessageController extends Controller
{
    public function setRoleAndPermission(Request $request){
        $user = User::create([
        	'name' => ''.$request->name.'', 
        	'email' => ''.$request->email.'',
        	'password' => ''.Hash::make($request->password).''
        ]);
  
        $role = Role::create(['name' => $request->role]);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);
        return $user ;
    }
    public function userRoles($id){
        $usersElequent = new User ;
        $roles = Role::all();
        $Permission = Permission::all();
        $users = $usersElequent::with('roles')->where('id',$id)->get();
        // $nonmembers = $users->reject(function ($user, $key) {
        //     return $user->hasRole('member');
        // });
        return response()->json(['roles'=>$roles, 'Permission' => $Permission ,  'users' => $users], 200);
    }
    public function getDataByName(){
        // send name like admin and it return who are admins
        $usersElequent = new User ;

        return $usersElequent::whereHas("roles", function($q){ $q->where("name", "Admin"); })->get();
    }
    public function checkAdminOrUser($userId){
        $userModel = new User ;
        $roles = Role::all();
        $userData = $userModel::with('roles')->where('id' , $userId)->get();
        if (count($userData[0]['roles']) > 0){
            return response()->json([ "data" => $userData[0]['roles'][0]['name'] , "success"=> 1  ], 200);
        } else {
            return response()->json([ "data" => "user" , "success"=> 2  ], 404);
        }
    }
    public function checkIfAdmin(){
        $user = new User ;
        $whichuser = $user::find(1);
        $roles = $whichuser->getRoleNames();
        return $roles[0] ;
    }
    public function checkAdmin(Request $request){
        $user = new User ;
        if ($user::where('id', $request->id)->exists()) {
            $userRole = $user::find(1);
            $roles = $userRole->getRoleNames();
            return response()->json([ "roles" => $roles  , "success"=> 1  ], 200);    
        } else {
            return response()->json([ "message" => "user not found" , "success"=> 2  ], 404);

        }
    }
    public function getUserData($id){
        $user = new User ;
        if($user::where('id', $id)->exists()){
            $userProfile = $user::where('id', $id)->get();
            return response()->json([ "message" => $userProfile ,  "success"=> 1  ], 200);
        } else {
            return response()->json([ "message" => "user not found" , "success"=> 2  ], 404);
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
            return response()->json([ "message" => "user not found" ], 404);
        }
    }
}
