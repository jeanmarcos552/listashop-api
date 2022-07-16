<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    public function addRoles()
    {
        $roles = [
            ['name' => 'Administrator'],
            ['name' => 'Editor'],
            ['name' => 'Author'],
            ['name' => 'Contributor'],
        ];

        Role::insert($roles);
        return "feito";
    }

    public function addUser()
    {
        $user = new User();
        $user->name = "jean";
        $user->email = "jean@gmail.com";
        $user->password = bcrypt("secret");
        $user->save();

        $user->roles()->attach([1, 2]);
        return "ok";
    }

    public function getAllRolesByUser($id) {
        $user = User::find($id);
        $roles = $user->roles;
        return $roles;
    }

    public function getAllUserByRoles($id) {
        $role = Role::find($id);
        $user = $role->users;
        return $user;
    }
}
