<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_register_id', // This field will be related to the UserRegister model
        'hospital',
        'telephone', // This field will be related to the UserRegister model
        'available_time_contact',
        'topic',
        'already_read',
    ];

    // Define the relationship with the UserRegister model
    public function userRegister()
    {
        // return $this->belongsTo(UserRegister::class, 'user_register_id', 'user_register_id');
        return $this->belongsTo(UserRegister::class);
    }
}
