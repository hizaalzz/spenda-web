<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::LOGIN;

    public function username()
    {
        return 'nis';    
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        try {
            activity()->log(auth()->user()->nama . ' telah logout');
        } catch(\Exception $ex) {
            goto logoutact;
        }

        logoutact:

        auth()->logout();
                
        return redirect()->route('login');
    }
}
