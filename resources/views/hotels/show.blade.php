@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-gray-800">{{ $hotel->name }}</h1>
        <p class="text-gray-600 mt-2">{{ $hotel->description }}</p>

        <h2 class="text-xl font-semibold text-gray-700 mt-6">Daftar Kamar</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            @foreach($hotel->rooms as $room)
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-semibold">{{ $room->name }}</h3>
                    <p class="text-gray-600">Harga: Rp{{ number_format($room->price, 0, ',', '.') }}</p>

                    <!-- Form untuk reservasi kamar -->
                    <form action="{{ route('reservations.store') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <label class="block text-gray-700">Check-in:</label>
                        <input type="date" name="check_in" class="border p-2 rounded w-full" required>

                        <label class="block text-gray-700 mt-2">Check-out:</label>
                        <input type="date" name="check_out" class="border p-2 rounded w-full" required>

                        <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">
                            Reservasi
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
