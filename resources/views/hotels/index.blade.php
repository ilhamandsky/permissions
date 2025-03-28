@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Hotel</h1>

        <!-- Form Pencarian -->
        <form action="{{ route('hotels.search') }}" method="GET">
            <input type="text" name="query" placeholder="Cari hotel..." required>
            <button type="submit">Cari</button>
        </form>

        <!-- Daftar Hotel -->
        <ul>
            @foreach($hotels as $hotel)
                <li>
                    <a href="{{ route('hotels.show', $hotel->id) }}">{{ $hotel->name }}</a> - {{ $hotel->description }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection
