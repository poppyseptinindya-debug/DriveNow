<?php

namespace App\Http\Controllers;

class RentalController extends Controller
{
    public function index()
    {
        return view('rentals');
    }
}
