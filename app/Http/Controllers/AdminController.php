<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public  function login_get()
    {
        return view('auth.login_admin');
    }

    public function login_post(Request $request)
    {
        $remember = $request->has('remember') ? true : false;
        if (\Auth::guard('webadmin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('logining');
        } else {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
            return redirect()->back();
        }
    }
}
