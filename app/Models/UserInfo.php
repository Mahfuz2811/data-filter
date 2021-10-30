<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'dob',
        'yob',
        'mob',
        'phone',
        'ip',
        'country'
    ];
}
