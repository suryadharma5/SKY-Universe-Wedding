<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('register.index');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:15', 'min:3'],
            'datingCode' => 'required|max:3|min:3',
            'birthDate' => 'required|before:today',
            'gender' => 'required',
            'phoneNumber' => 'max:12|min:10',
            'photo'=> 'image|file|max:1024',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'email:dns'],
            'password' => ['required', 'min:5'],
        ]);

        $validatedData['photo'] = $request->file('photo')->store('profile-images');
        $validatedData['dating_id'] = 'SKY'. $request->datingCode . '0' . $request->gender;
        $validatedData['password'] = Hash::make($validatedData['password']);

        $gender = User::all();
        foreach ($gender as $g){
            if($g->datingCode == $validatedData['datingCode'] && $g->gender === $validatedData['gender']){
                return redirect('/register')->with('error', 'Dating Code Sudah Terpakai');
            }
        }
        // dd($validatedData);

        $user = User::create($validatedData);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/')->with('success', 'Congratulations your account have been created, 
        you can login using '.  $request->email .' or ' . $validatedData['dating_id']);
    }
}
