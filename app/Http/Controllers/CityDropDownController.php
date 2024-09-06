<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CityDropDownController extends Controller
{
    public function index()
    {

        $country = Country::all();
        $states = State::all();
        dd($states);
        return view('frontend.index', compact('countries', 'states'));

    }
}
