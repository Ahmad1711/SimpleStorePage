<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function create($name){

        Role::create([
            'name'=>$name
        ]);

    }

    public function give_role_to_user($user,$role){

        $user_name=User::where('name',$user)->first();
        $role_name=Role::findByName($role);

        $user_name->assignRole($role_name);
    }
}
