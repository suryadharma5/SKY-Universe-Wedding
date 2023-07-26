<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{

    public function index(){
        return view('booking.index', [
            'bookings' => Booking::where('user_id', Auth::user()->id)->get(),
        ]);
    }
    public function store(Request $request){
        $validatedData = [];
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255','email:dns'],
            'phone' => 'max:11|min:9',
            'date' => 'required|after:today',
            'payment' => 'required'
        ]);

        $date = Carbon::parse($request->date);
        $date = $date->format('l jS \\of F Y');
        echo $date;

        $validatedData['user_id'] = $request->user_id;
        $validatedData['venue_id'] = $request->venue_id;
        $validatedData['date'] = $date;

        Booking::create($validatedData);

        return redirect('/bookings')->with('success', 'Booking Success');

    }

    public function random(Request $request){
       $bank = $request->bank;
       $uniq = '';

       $randomNumber = mt_rand(100000000, 999999999);

       if($bank == 1){
        $uniq = 14;
       }else if ($bank == 2) {
        $uniq = 9;
       }else if ($bank == 3){
        $uniq = 8;
       }else{
        $uniq = 2;
       }

       $va = '00'.$uniq.$randomNumber;

       return response()->json($va);

    }
}
