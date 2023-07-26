<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('login.index');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // dd($request);
        $attempt = User::where('email', $request->email)->first();
        
        if(!$attempt){
            $attempt = User::where('dating_id', $request->email)->first();
            // dd($attempt);
        }

        

        if($attempt){
            if($attempt->is_banned == 1){
                return redirect('/login')->with('banned', 'You are banned from this website');
            }else {
                $request->authenticate();
                
                $request->session()->regenerate();
                
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }else {
            $request->authenticate();
                
            $request->session()->regenerate();
            
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        // $credentials = $request->only('email', 'password');
        // // $credentials['password'] = Hash::make($credentials['password']);
        // // dd($credentials);
        

        // if (Auth::attempt($credentials)) {
        //     // Authentication passed...
        //     return redirect(RouteServiceProvider::HOME);
        // } else {
        //     return redirect()->route('login')->with('error', 'Invalid credentials');
        // }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
