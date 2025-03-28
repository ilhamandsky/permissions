<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Menampilkan daftar reservasi user
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())->with('room.hotel')->get();
        return view('reservations.index', compact('reservations'));
    }

    // Menyimpan reservasi baru
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
            'status' => 'pending', // Status awal pending
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dilakukan.');
    }

    // Membatalkan reservasi
    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'pending') {
            abort(403, 'Tidak dapat membatalkan reservasi ini.');
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
