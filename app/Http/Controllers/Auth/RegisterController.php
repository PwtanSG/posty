<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //only show register page for guest
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //validate, if fail throw exception, else continue next code
        $this->validate($request, [
            'name'=>'required|max:255',
            'username'=>'required|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|confirmed',
        ]);

        //Eloquent -> dB
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email','password'));

        //redirect
        return redirect()->route('dashboard');
        //return redirect('/posts');
    }
}
