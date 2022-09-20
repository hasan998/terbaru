<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticable
{
    use HasFactory,Notifiable; 

    protected $guarded = ['admin_id'];
    protected $primaryKey = 'admin_id';
    protected $hidden = ['password'];
}