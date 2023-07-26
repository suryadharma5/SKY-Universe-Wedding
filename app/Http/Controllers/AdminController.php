<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin', [
            'users' => User::all(),
        ]);
    }

    public function ban(Request $request){
        // dd($request);
        $user = User::findOrFail($request->user_id);

        if($user->is_banned == 1){
            $user->is_banned = 0;
            $user->save();
            return redirect('/admin')->with('success', 'User unbanned from this server');
        }else if ($user->is_banned == 0) {            
            $user->is_banned = 1;
            $user->save();
            return redirect('/admin')->with('success', 'User banned from this server');
        }

        
    }
}
