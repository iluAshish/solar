<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'occupation',
        'city',
        'state',
        'location',
        'investment',
        'hear',
        'interested'
    ];
}
