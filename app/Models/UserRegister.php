<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegister extends Model
{
    use HasFactory;
    protected $escapeWhenCastingToString = false;

    protected $fillable = [
        'line_token',
        'line_img',
        'first_name',
        'last_name',
        'career_id',
        'specialty_id',
        'license_number',
        'email',
        'telephone',
        'consented',
        'agent',
        'event',
        'status',
    ];

    // Define relationships

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    // Set default values for certain fields
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->agent = $model->agent ?? 'NULL';
            $model->event = $model->event ?? 'NULL';
            $model->status = $model->status ?? 'NULL';
        });
    }
}
