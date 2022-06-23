<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('list-role', Role::class);

        if (request()->ajax()) :
            $query = Role::query();

            return datatables()->of($query)
                ->addColumn('action', 'settings.role.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        endif;
        return view('settings.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-role', Role::class);
        $permissions = PermissionGroup::with('permissions')->get();
        return view('settings.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('create-role', Role::class);
        try {
            DB::beginTransaction();
            $role = Role::create($request->all());
            $role->permissions()->sync($request->permissions);
            DB::commit();
            Toastr::success('Role successfully created!', 'Success');
            return redirect()->route('role.index')->with('success', 'Role created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Failed to save Role!', 'Error');
            return redirect()->route('role.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('view-role', Role::class);
        $permissions = PermissionGroup::with('permissions')->get();
        return view('settings.role.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('show-role', Role::class);
        $permissions = PermissionGroup::with('permissions')->get();
        $selectedPermissions = $role->permissions()->pluck('permission_id')->toArray();

        return view('settings.role.edit', compact('role', 'permissions', 'selectedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('edit-role', Role::class);
        try {
            DB::beginTransaction();
            $role->update($request->all());
            $role->permissions()->sync($request->permissions);
            DB::commit();
            Toastr::success('Role successfully updated!', 'Success');
            return redirect()->route('role.index')->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Failed to update Role!', 'Error');
            return redirect()->route('role.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete-role', Role::class);
        try {
            $role = Role::find($id);
            $role->delete();
            return response()->json(['success' => true, 'message' => 'Role deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
