<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Admin extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        "name",
        "email",
        "photo",
        "password",
    ];


    protected $hidden = ['password'];



}
