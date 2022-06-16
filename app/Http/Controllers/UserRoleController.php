<?php

namespace App\Http\Controllers;

use App\Models\PermissionHeader;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    function index(){
        $users = User::all();
        return view('userspermission.index',compact('users'));
    }

    function setpermission($id){


        $rolePermission = UserPermission::where('role_id',$id)->get();
        $permissions = PermissionHeader::get();


        return view('userspermission.add',compact('id','rolePermission','permissions'));
    }

    public function permissionSubmit(Request $request){
        UserPermission::where('role_id',$request->user_id)->delete();
        foreach (array_slice($request->all(), 2) as $permission){
            UserPermission::create(
                [
                    'role_id'   => $request->user_id,
                    'permission_id'   => $permission,

                ]
            );
        }

        return redirect()->back();
    }

}
