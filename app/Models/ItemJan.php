<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemJan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_id',
        'jan',
        'status_id',
    ];

    public function item() {
        return $this->belongsTo('App\Models\Item');
    }

    public function status() {
        return $this->belongsTo('App\Models\Status');
    }

}
