<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Author extends Model
{
    use HasFactory ,HasApiTokens;
    protected $hidden =[
        'created_at','updated_at'
    ];
    protected $fillable=[
        "name", "email", "password", "phone_no"
    ];
}
