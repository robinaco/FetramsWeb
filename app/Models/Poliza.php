<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    use HasFactory;
    protected $casts = [
        'hoursin' => 'date:hh:mm',
        'hoursfin' => 'date:hh:mm',
    ];
}
