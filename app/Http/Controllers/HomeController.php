<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user() && auth()->user()->isRole('admin')){
        return view('home');
        }

        return view('welcome');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'name'      => 'bail|required|alpha_dash|min:6',
            'password'  => 'bail|required|min:8',
        ]);
        if(Auth::attempt($validated)){
            $request->session()->regenerate();
            Auth::login(
                User::where('name',$validated['name'])->first()
            );
            return redirect()->intended('/home');
        }
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
