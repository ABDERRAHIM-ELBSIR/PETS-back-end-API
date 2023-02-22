<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = ['request_from', 'request_to', 'status'];

    public function user_info(){
        return $this->hasOne(User::class);
    }
}