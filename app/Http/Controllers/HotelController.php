<?php

namespace App\Http\Controllers;
use App\Models\Hotel;
use Illuminate\Http\Request;
class HotelController extends Controller {
    public function index() {
        return view('hotels.index', ['hotels' => Hotel::all()]);
    }
    public function show($id) {
        return view('hotels.show', ['hotel' => Hotel::findOrFail($id)]);
    }
}