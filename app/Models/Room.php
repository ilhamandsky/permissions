<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Room extends Model {
    protected $fillable = ['hotel_id', 'room_type', 'price'];
    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }
}