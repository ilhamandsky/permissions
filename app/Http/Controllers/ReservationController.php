<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Menampilkan daftar reservasi milik user yang sedang login
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())->get();
        return view('reservations.index', compact('reservations'));
    }

    // Menyimpan pemesanan kamar
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'pending',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Pemesanan berhasil.');
    }

    // Membatalkan reservasi (hanya jika masih pending)
    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk membatalkan reservasi ini.');
        }

        if ($reservation->status !== 'pending') {
            return redirect()->route('reservations.index')->with('error', 'Reservasi tidak bisa dibatalkan.');
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
