@extends('layouts.app')

@section('title', $hotel->name)

@section('content')
    <h1>{{ $hotel->name }}</h1>
    <p>{{ $hotel->description }}</p>

    <h2 class="mt-4">Kamar Tersedia</h2>
    <div class="row">
        @foreach ($hotel->rooms as $room)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kamar {{ $room->type }}</h5>
                        <p class="card-text">Harga: Rp {{ number_format($room->price, 0, ',', '.') }}</p>
                        <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
