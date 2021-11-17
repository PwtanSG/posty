<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //only show register page for guest
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        //validate, if fail throw exception, else continue next code
        //dd($request->remember);
        $this->validate($request, [
            'email' => 'required|email|',
            'password' => 'required',
        ]);
        //attempt login
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login credentials');
        }
        //dd($request);
        return redirect()->route('dashboard');
    }
}
