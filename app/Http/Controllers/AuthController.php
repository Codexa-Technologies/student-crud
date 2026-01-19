<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show register form
    public function showRegister(){
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request){
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|confirmed'
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('login')->with('success','Account created! Please login.');
    }

    // Show login form
    public function showLogin(){
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request){
        $data = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = User::where('email',$data['email'])->first();
        if($user && Hash::check($data['password'],$user->password)){
            // Log the user into Laravel's authentication system so Auth::check() works
            Auth::loginUsingId($user->id);
            return redirect()->route('students.index'); // protected route
        }

        return back()->withErrors(['email'=>'Invalid email or password']);
    }

    // Logout
    public function logout(){
        Auth::logout();
        session()->forget(['user_id','user_name']);
        return redirect()->route('login');
    }
}
