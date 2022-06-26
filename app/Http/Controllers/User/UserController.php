<?php

namespace App\Http\Controllers\User;

use App\Helpers\Mail\MailHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\{Role, User};
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use MailHelper;

    public function index(Request $request)
    {
        $this->authorize('list-user', User::class);

        if (request()->ajax()) :
            $query = User::where('id', '!=', 1);

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

        $roles          = Role::select('id', 'name')->get();
        return view('settings.user.create', compact('roles'));
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
                'mobile'    => $request->mobile,
                'address'   => $request->address,
                'status'    => $request->status ?? 1,
            ];
            $user = User::create($userData);
            $user->roles()->attach($request->role_id);
            DB::commit();
            $this->sendMailForUserCreate($user);
            Toastr::success('User data successfully created!', 'Success');
            return redirect()->route('user.index')->withInput();
        } catch (\Exception $error) {

            DB::rollBack();
            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back()->with('error', $error->getMessage())->withInput();
        }
    }

    public function edit(User $user)
    {
        $this->authorize('show-user', User::class);
        $roles = Role::select('id', 'name')->get();
        $role_user = DB::table('role_user')
            ->where('user_id', '=', $user->id)->get();

        return view('settings.user.edit', compact('user', 'roles', 'role_user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('edit-user', User::class);

        DB::beginTransaction();
        try {
            $userData = [
                'name'      => $request->name,
                'email'     => $request->email ?? $user->email,
                'mobile'    => $request->mobile,
                'address'   => $request->address,
                'status'    => $request->status ?? $user->status,
            ];
            $user->update($userData);

            if ($user) {
                $user->roles()->sync($request->role_id);
            }

            DB::commit();
            Toastr::success('User successfully updated!', 'Success');
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
            $user = User::find($id);
            $user->delete();
            $user->roles()->detach();
            return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
        } catch (\Exception $error) {

            return response()->json(['success' => false, 'message' => $error->getMessage()]);
        }
    }
    
    public function changePassword(Request $request, $id)
    {
        $this->authorize('edit-user', User::class);
        try {
            $request->validate([
                'old_password'          => 'required',
                'new_password'          => 'required|min:6',
                'new_confirm_password'  => 'same:new_password',
            ]);
            $user = User::where('id', $id)->first();

            if (!Hash::check($request->old_password, $user->password)) {
                return back()->with("error", "Old Password Doesn't match!");
            }

            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            Toastr::success('Password successfully updated!', 'Success');
            return redirect()->route('user.index')->withInput();
        } catch (\Exception $error) {

            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back();
        }
    }
}
