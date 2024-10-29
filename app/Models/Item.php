<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Askedio\SoftCascade\SoftCascade;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $softCascade = ['itemJans', ];

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'series',
        'detail',
        'published_on',
        'classification',
        'code',
        'price',
        'type_code',
        'file_name',
        'file_path',
    ];

    protected function available(): Attribute
    {
        return Attribute::make(
            get: fn () =>
                $this->ItemJans->where('status_id', 1)->count()
        );
    }

    public function itemJans()
    {
        return $this->hasMany('App\Models\ItemJan');
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }
}
