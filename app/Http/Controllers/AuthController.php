<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function sign()
    {
        return view('auth.sign');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function sign_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:250|',
            'email' => 'required|email:rfc,dnc|max:250|unique:users,email',
            'password' => 'required|min:8|',
            'password_confirmation' => 'required|same:password'
        ]);

        $validated['password'] = Hash::make($validated['password']);
//        dd($validated);

        $user = User::create($validated);

        auth()->login($user);

        return redirect('/')->with('success','Account successfully registered.');
    }

//    public function usercomment()
//    {
//        $post = Post::all();
//        return redirect()->route('posts.show',['post'=>$post->id]);
//{{auth()->user()->name}}
//    }

}
