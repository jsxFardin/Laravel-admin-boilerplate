<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile()
    {
        $this->authorize('show-user', User::class);
        $user = Auth::user();
        return view('settings.user.profile.index', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('edit-user', User::class);

        DB::beginTransaction();
        try {
            $userData = [
                'name'      => $request->name ?? $user->name,
                'email'     => $request->email ?? $user->email,
                'mobile'    => $request->mobile ?? $user->mobile,
                'address'   => $request->address
            ];
            Auth::user()->update($userData);

            DB::commit();
            Toastr::success('Profile successfully updated!', 'Success');
            return redirect()->route('user.profile')->withInput();
        } catch (\Exception $error) {

            DB::rollBack();
            Toastr::warning($error->getMessage(), 'Warning');
            return redirect()->back()->with('error', $error->getMessage())->withInput();
        }
    }
}
