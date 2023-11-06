<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUserRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        // Add any additional fields that you want to be fillable        
        'event_id', 'user_register_id', 'status', // Example field, you can customize as needed
    ];

    // Define relationships if any
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
