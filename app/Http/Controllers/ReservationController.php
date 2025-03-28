<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Http\Request;
class ReservationController extends Controller {
    public function index() {
        return view('admin.reservations', ['reservations' => Reservation::all()]);
    }
    public function store(Request $request) {
        Reservation::create($request->all());
        return back();
    }
    public function accept($id) {
        Reservation::findOrFail($id)->update(['status' => 'accepted']);
        return back();
    }
    public function reject($id) {
        Reservation::findOrFail($id)->update(['status' => 'rejected']);
        return back();
    }
}