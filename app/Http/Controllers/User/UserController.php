<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\EmployeeDetail;
use App\Models\Role;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $bloodGroup = ['A+', 'B+', 'O+', 'AB+', 'A-', 'B-', 'O-', 'AB-'];


    public function index(Request $request)
    {
        $this->authorize('list-user', User::class);

        if (request()->ajax()) :
            $query = User::query();

            return datatables()->of($query)
                ->addColumn('action', 'settings.user.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        endif;

        return view('settings.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-user', User::class);

        $bloodGroup     = $this->bloodGroup;
        $roles          = Role::select('id', 'name')->get();
        $branches       = Branch::select('id', 'name')->get();
        $departments    = Department::select('id', 'name')->get();
        $designations   = Designation::select('id', 'name')->get();
        $users          = User::select('id', 'name')->get();
        return view(
            'settings.user.create',
            compact(
                'roles',
                'branches',
                'departments',
                'designations',
                'users',
                'bloodGroup'
            )
        );
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create-user', User::class);

        DB::beginTransaction();
        try {
            $userData = [
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ];
            $user = User::create($userData);

            if ($user) {
                $user->roles()->attach($request->role_id);
                $employeeInfo = [
                    'user_id'               => $user->id,
                    'branch_id'             => $request->branch_id,
                    'department_id'         => $request->department_id,
                    'designation_id'        => $request->designation_id,
                    'supervisor_id'         => $request->supervisor_id,
                    'employee_id'           => random_int(100000, 999999),
                    'mobile'                => $request->mobile,
                    'address'               => $request->address,
                    'blood_group'           => $request->blood_group,
                    'joining_date'          => $request->joining_date,
                    'accommodation_cost'    => $request->accommodation_cost,
                    'daily_allowance_cost'  => $request->daily_allowance_cost,
                ];
                EmployeeDetail::create($employeeInfo);
            }

            DB::commit();
            Toastr::success('User data successfully created!', 'Success');
            return redirect()->route('user.index')->withInput();
        } catch (\Exception $error) {

            DB::rollBack();
            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back()->with('error', $error->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $this->authorize('show-user', User::class);

        $bloodGroup = $this->bloodGroup;
        $roles          = Role::select('id', 'name')->get();
        $branches       = Branch::select('id', 'name')->get();
        $departments    = Department::select('id', 'name')->get();
        $designations   = Designation::select('id', 'name')->get();
        $users          = User::select('id', 'name')->get();
        $user           = User::findOrFail($id);
        $role_user      = DB::table('role_user')
            ->where('user_id', '=', $user->id)->get();

        return view(
            'settings.user.edit',
            compact(
                'roles',
                'branches',
                'departments',
                'designations',
                'users',
                'bloodGroup',
                'user',
                'role_user'
            )
        );
    }

    public function update(UserRequest $request, $id)
    {
        $this->authorize('edit-user', User::class);

        DB::beginTransaction();
        try {
            $userData = [
                'name'      => $request->name,
                'email'     => $request->email,
            ];
            $user = User::findOrFail($id);
            $user->update($userData);

            if ($user) {
                $user->roles()->sync($request->role_id);
                $employeeInfo = [
                    'user_id'               => $user->id,
                    'branch_id'             => $request->branch_id,
                    'department_id'         => $request->department_id,
                    'designation_id'        => $request->designation_id,
                    'supervisor_id'         => $request->supervisor_id,
                    'mobile'                => $request->mobile,
                    'address'               => $request->address,
                    'blood_group'           => $request->blood_group,
                    'joining_date'          => $request->joining_date,
                    'accommodation_cost'    => $request->accommodation_cost,
                    'daily_allowance_cost'  => $request->daily_allowance_cost,
                ];
                EmployeeDetail::updateOrCreate(['id' => $request->employee_details_id], $employeeInfo);
            }

            DB::commit();
            Toastr::success('User data successfully updated!', 'Success');
            return redirect()->route('user.index')->withInput();
        } catch (\Exception $error) {

            DB::rollBack();
            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back()->with('error', $error->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $this->authorize('delete-user', User::class);

        try {
            $user = User::findOrFail($id);
            $user->delete();
            $user->roles()->detach();

            if ($user) {
                EmployeeDetail::where('user_id', '=', $user->id)->delete();
            }

            Toastr::success('User data successfully deleted!', 'Success');
            return redirect()->back();
        } catch (\Exception $error) {

            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back();
        }
    }

    public function changePassword(Request $request, $id)
    {
        $this->authorize('edit-user', User::class);

        # Validation
        $request->validate([
            'old_password'          => 'required',
            'new_password'          => 'required|min:6',
            'new_confirm_password'  => 'same:new_password',
        ]);
        $user = User::where('id', $id)->first();

        #Match The Old Password
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        #Update the new Password
        User::findOrFail($id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        Toastr::success('Password successfully updated!', 'Success');
        return redirect()->route('user.index')->withInput();
    }
}
