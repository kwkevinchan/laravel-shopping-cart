<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class ProductClass extends Model
{
    use Uuids;

    public $incrementing = false;


    protected $fillable = [
        'name', 'detail'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}