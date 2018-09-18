<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use App\User;

class Product extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'productclass_id',
        'name',
        'detail',
        'price',
        'volume'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product_classes()
    {
        return $this->belongsTo(ProductClass::class, 'productclass_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Cart::class);
    }

}
