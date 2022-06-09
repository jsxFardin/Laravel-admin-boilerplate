<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    public function index()
    {
        // GET USER ROLE DATA
        // $getUserCollection = User::with(['role.permissions'])->get();
        // $userRoles = $getUserCollection->map(function ($item) {
        //     return [
        //         'id'            => $item->id,
        //         'name'          => $item->name,
        //         'email'         => $item->email,
        //         'role_id'       => $item->role_id,
        //         'role_name'     => $item->role->name,
        //         'permissions'   => $item->role->permissions,
        //     ];
        // });
        // return $userRoles;


        // GET PERMISSION DATA
        // $getPermissionCollection = Permission::with(['roles'])->get();
        // $permissions = $getPermissionCollection->map(function ($item) {
        //     return [
        //         'id'    => $item->id,
        //         'name'  => $item->name,
        //         'label' => $item->label,
        //         'roles' => $item->roles->map(function ($role) {
        //             return [
        //                 'id'            => $role->id,
        //                 'name'          => $role->name,
        //                 'label'         => $role->label,
        //                 'permission_id' => $role->pivot->permission_id,
        //                 'role_id'       => $role->pivot->role_id
        //             ];
        //         })
        //     ];
        // });
        // return  $permissions;

        return view('dashboard');
    }
}
