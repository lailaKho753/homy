<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Other properties and methods...

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime', 
    ];
    protected $fillable = [
        'name', 'email', 'password',
    ];    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
