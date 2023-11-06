<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'thumbnail',
    ];

    // Additional attributes to be mutated to dates
    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];
}
