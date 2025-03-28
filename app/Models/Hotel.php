<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Hotel extends Model {
    
    use HasFactory;

    protected $fillable = ['name', 'description', 'location']; // Tambahkan 'location'

    public function rooms() {
        return $this->hasMany(Room::class, 'hotel_id','id');
    }
}
