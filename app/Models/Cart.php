<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Cart extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'volume'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
