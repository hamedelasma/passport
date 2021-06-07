<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Passport\HasApiTokens;

class Author extends Model implements AuthenticatableContract
{
    use HasFactory ,HasApiTokens , Authenticatable;
    protected $hidden =[
        'created_at','updated_at'
    ];
    protected $fillable=[
        "name", "email", "password", "phone_no"
    ];
}
