<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Friend extends Model
{
    use HasFactory ,Notifiable;

    protected $fillable = ['request_from', 'request_to', 'status'];


}