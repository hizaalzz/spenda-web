<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required|numeric',
            'old_password' => 'nullable',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ], 
        ['password.confirmed' => 'Konfirmasi password salah']);

        if($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator);
        }

        $logged = Auth::guard('admin')->user();

        $this->applyExtraValidation($logged, $request);

        $admin = Admin::find($request->admin_id);

        if($request->has('old_password')) 
        {
            if(Hash::check($request->old_password, $admin->password)) 
            {
                $admin->password = bcrypt($request->password);

                $admin->save();
                
            } else {
                return redirect()->route('admin.index')->withErrors('Password lama salah');

            }
        } else {
            $admin->password = bcrypt($request->password);

            $admin->save();
        }

        return redirect()->route('admin.index')->with('success', 'Berhasil mengupdate password');
    }

    public function applyExtraValidation($user, $request) 
    {
        if(!$user->hasRole('admin') && !$user->hasRole('guru')) return abort(404);

        if(!$user->hasRole('admin') && $user->id !== $request->admin_id) return abort(404);

        if(!$user->hasRole('admin') && !$request->has('old_password')) return abort(404);

    }
}
