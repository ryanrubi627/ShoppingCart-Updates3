<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class superAdmin_page extends Controller
{
	//USE FOR DISPLAY DATA INTO TABLE FROM DATABASE..
	public function index(){
		
	    $user = User::with('roles')->get();
     	return view('superAdmin_page')->with('users', $user);

	}

	//DELETE USER..
	public function delete_user(Request $request){
		$id = $request->id;
		User::where('id', $id)->delete();
	}

	//REGISTER USER..
	public function register_user(Request $request){
		$User = new User;
		$User->name = $request->name;
		$User->email = $request->email;
		$User->password = Hash::make($request->password);
		$User->save();

		$id = User::find($User->id);
		$role = $request->roles;
		$permission = $request->permission;
		$id->assignRole($role);
		$id->givePermissionTo($permission);
	}

	//UPDATE USER..
	public function update_user(Request $request){
		$id = $request->id;
		$name = $request->name;
		$email = $request->email;
		$roles_id = $request->roles;
		$permission = $request->edt_permission;

		User::where('id', $id)
                ->update(['name' => $name, 'email' => $email]);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        DB::table('model_has_permissions')->where('model_id',$id)->delete();
       	$user = User::find($id);
        $user->assignRole($roles_id);
        $user->givePermissionTo($permission);
	}
}
