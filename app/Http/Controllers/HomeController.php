<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index(){
        $locale = session()->get('locale');
        App::setLocale($locale);
        return view('index', [
            'venues' => Venue::all(),
            'title' => 'wedding',
            'active' => 'home',
        ]);
    }  

    public function filters(Request $request){
        // dd($request->all());
        $id_loc = $request->id_loc;
        $location = Location::where('id', $id_loc)->get();
        $location = $location[0]['name'];

        $venues = Venue::where('location_id', $id_loc)->get();

        foreach($venues as $venue){
            echo "<div class='wedding-option mb-4'>
            <div class='venue col-lg-12 p-3 d-flex flex-row'>
                <img src='https://source.unsplash.com/450x250/?$location' alt='/img/back.jpg' class='img-fluid venue-img'>
                <div class='description ms-4 d-flex flex-column col-lg-4'>
                    <h3 class='fw-bold'> $venue->name </h3>
                    <p>$venue->description </p>
                    <div class='venue-loc d-flex '>
                        <i class='bi bi-geo-alt-fill mt-1' style='color: #e7c790'></i>
                        <p class='ms-2'>Jl. $venue->location, $location</p>
                    </div>

                    <div class='venue-loc d-flex '>
                        <i class='bi bi-piggy-bank-fill mt-1' style='color: #e7c790'></i>
                        <p class='fw-bold ms-1' style='color: #e7c790'>$</p>
                        <p class='ms-2'>$venue->price</p>
                    </div>

                </div>
                <div class='btn-aja d-flex align-items-end justify-content-end col-lg me-3'>
                    <a href = '/book/$venue->id' type='button' class='fw-bold book-btn btn'>Book Now</a>
                </div>
            </div>
            </div>";
        
        };
    }

    public function detail(Venue $venue){
        $locale = session()->get('locale');
        App::setLocale($locale);
        
        $price = (int)$venue->price;
        $tax = $price * 10/100;
        $service = $price * 5/100;
        $other = $price*2/100;
        $price = $price + $tax + $service + $other;
        return view('detail', [
            'venue' => $venue,
            'total' => $price,
            'tax' => $tax,
            'service' => $service,
            'other' => $other,

        ]);
    }
}
