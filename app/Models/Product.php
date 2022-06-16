<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table='products';
    protected $primaryKey='product_id';
    public $timestamps = true;


    public function category()
    {
        return $this->hasOne('App\Models\Category', 'category_id', 'category_id');
    }

    public function brand()
    {
        return $this->hasOne('App\Models\Brand', 'brand_id', 'brand_id');
    }
}
