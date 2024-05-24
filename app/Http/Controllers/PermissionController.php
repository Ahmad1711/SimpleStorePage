<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function create($name){

        Permission::create([
            'name'=>$name
        ]);

    }

    public function give_permission_to_role($role,$permission){

        $role_name=Role::findByName($role);
        $permission_name=Permission::findByName($permission);

        $role_name->givePermissionTo($permission_name);
    }

    public function remove_permission_from_role($role,$permission){

        $role_name=Role::findByName($role);
        $permission_name=Permission::findByName($permission);

        $role_name->revokePermissionTo($permission_name);
    }

    public function give_permission_to_user($user,$permission){

        $user_name=User::where('name',$user)->first();
        $permission_name=Permission::findByName($permission);

        $user_name->givePermissionTo($permission_name);
    }

    public function get_user_permissions($user){

        $user_name=User::where('name',$user)->first();
        return $user_name->permissions;
    }
}
