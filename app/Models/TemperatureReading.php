<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TemperatureReading extends Model
{
    use HasFactory;

    // Specify which fields can be mass-assigned
    protected $fillable = ['temperature', 'created_at'];

    // Ensure created_at is treated as a Carbon instance
    protected $dates = ['created_at', 'updated_at']; 

    public function getCustomCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y H:i:s');
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Jakarta');
    }
}

