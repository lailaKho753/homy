<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toggle extends Model
{
    use HasFactory;
    protected $fillable = [
        'lamp_id',
        'state', // Include other attributes if necessary
    ];
}
