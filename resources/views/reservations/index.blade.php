@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-gray-800">Reservasi Saya</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 mt-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-6">
            @foreach($reservations as $reservation)
                <div class="bg-white p-4 rounded shadow mb-4">
                    <p><strong>Kamar:</strong> {{ $reservation->room->name }}</p>
                    <p><strong>Check-in:</strong> {{ $reservation->check_in }}</p>
                    <p><strong>Check-out:</strong> {{ $reservation->check_out }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($reservation->status) }}</p>

                    @if($reservation->status === 'pending')
                        <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded mt-2">
                                Batalkan Reservasi
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
