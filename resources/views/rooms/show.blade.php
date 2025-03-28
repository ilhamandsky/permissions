@extends('layouts.app')

@section('title', 'Detail Kamar')

@section('content')
    <h1>Kamar {{ $room->type }}</h1>
    <p>Harga: Rp {{ number_format($room->price, 0, ',', '.') }}</p>
    <p>{{ $room->description }}</p>

    <h2 class="mt-4">Pesan Kamar Ini</h2>
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">

        <div class="mb-3">
            <label for="check_in" class="form-label">Tanggal Check-In</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="check_out" class="form-label">Tanggal Check-Out</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Pesan Sekarang</button>
    </form>
@endsection
