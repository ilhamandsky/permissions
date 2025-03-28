<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // Menampilkan daftar hotel
    public function index()
    {
        $hotels = Hotel::all();
        return view('dashboard', compact('hotels'));
    }

    // Menampilkan detail hotel berdasarkan ID
    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    // Pencarian hotel berdasarkan nama atau deskripsi
    public function search(Request $request)
    {
        $query = $request->input('query');
        $hotels = [];

        if ($query){

            $hotels = Hotel::where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->get();
        }


        return view('hotels.index', compact('hotels'));
    }
}
