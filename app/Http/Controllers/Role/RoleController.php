<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $this->authorize('list-role', Role::class);

        $roles = Role::paginate(10);
        return view('settings.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-role', Location::class);
        $permissions = PermissionGroup::with('permissions')->get();
        return view('settings.role.create', compact('permissions'));
    }
}
