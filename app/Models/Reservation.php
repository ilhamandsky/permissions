<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {
    protected $fillable = ['user_id', 'room_id', 'status', 'check_in', 'check_out'];

    protected $casts = [
        'status' => 'string', // Pastikan status selalu diperlakukan sebagai string
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }
}
