@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-gray-800">Dashboard User</h1>
        <p class="text-gray-600 mt-2">Selamat datang, {{ Auth::user()->name }}!</p>

        <!-- Cari Hotel -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700">Cari Hotel</h2>
            <form action="{{ route('hotels.search') }}" method="GET" class="mt-2">
                <input type="text" name="query" class="border p-2 rounded w-full" placeholder="Cari hotel...">
                <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">Cari</button>
            </form>
        </div>

        <!-- List Hotel -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700">Daftar Hotel</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                @foreach($hotels as $hotel)
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="text-lg font-semibold">{{ $hotel->name }}</h3>
                        <p class="text-gray-600">{{ $hotel->description }}</p>
                        <a href="{{ route('hotels.show', $hotel->id) }}"
                            class="mt-2 inline-block bg-green-600 text-white px-4 py-2 rounded">
                            Lihat Detail
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Reservasi Saya -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700">Reservasi Saya</h2>
            <a href="{{ route('reservations.index') }}" class="mt-2 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                Lihat Reservasi
            </a>
        </div>
    </div>
@endsection
