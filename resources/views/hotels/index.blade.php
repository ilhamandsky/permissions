@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-gray-800">Reservasi Saya</h1>

        <table class="table-auto w-full mt-6 border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Hotel</th>
                    <th class="border border-gray-300 px-4 py-2">Kamar</th>
                    <th class="border border-gray-300 px-4 py-2">Check-in</th>
                    <th class="border border-gray-300 px-4 py-2">Check-out</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $reservation->room->hotel->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reservation->room->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reservation->check_in }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reservation->check_out }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ ucfirst($reservation->status) }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($reservation->status === 'pending')
                                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                                        Batalkan
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500">Tidak dapat dibatalkan</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
