<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keep extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_jan',
        'start_at',
        'end_at',
        'status',
        'canceled_at'
    ];
}
