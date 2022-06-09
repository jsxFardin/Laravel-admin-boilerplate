<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('list-user', User::class);

        $users = User::paginate(10);
        $users->getCollection()->transform(function ($user) {
            $user->branch               = $user->employeeDetail->branch->name ?? null;
            $user->department           = $user->employeeDetail->department->name ?? null;
            $user->designation          = $user->employeeDetail->designation->name ?? null;
            $user->employee_id          = $user->employeeDetail->employee_id ?? null;
            $user->mobile               = $user->employeeDetail->mobile ?? null;
            $user->address              = $user->employeeDetail->address ?? null;
            $user->blood_group          = $user->employeeDetail->blood_group ?? null;
            $user->joining_date         = $user->employeeDetail->joining_date ?? null;
            $user->accommodation_cost   = $user->employeeDetail->accommodation_cost ?? null;
            $user->daily_allowance_cost = $user->employeeDetail->daily_allowance_cost ?? null;
            $user->supervisor           = $user->employeeDetail->supervisor ?? null;
            
            return collect($user)->forget(['employee_detail', 'email_verified_at', 'created_at', 'updated_at']);
        });
        // return $users;
        
        return view('settings.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-user', User::class);

        $roles          = Role::select('id', 'name')->get();
        $branches       = Branch::select('id', 'name')->get();
        $departments    = Department::select('id', 'name')->get();
        $designations   = Designation::select('id', 'name')->get();
        $users          = User::select('id', 'name')->get();
        return view('settings.user.create', 
            compact('roles', 'branches', 'departments', 'designations', 'users'));
    }
}
