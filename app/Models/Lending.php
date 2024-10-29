<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_jan',
        'checkout_at',
        'return_at',
        'due_at',
    ];

    public function user() {
        $this->belongsTo('App\Models\User');
    }
}
