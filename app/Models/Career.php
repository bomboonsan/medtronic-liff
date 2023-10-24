<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];

    // Define relationships

    public function userRegisters()
    {
        return $this->hasMany(UserRegister::class);
    }
}
