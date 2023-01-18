<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userFeedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'message'
    ];
}
