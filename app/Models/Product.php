<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'slug',
    'category_id',
    'brand_id',
    'mrp',
    'selling_price',
    'vat',
    'quantity',
    'status',
    'img_src',
    'description',
  ];

  protected $casts = [
    'id'            => 'integer',
    'name'          => 'string',
    'slug'          => 'string',
    'category_id'   => 'integer',
    'brand_id'      => 'integer',
    'mrp'           => 'decimal:2',
    'selling_price' => 'decimal:2',
    'vat'           => 'decimal:2',
    'quantity'      => 'integer',
    'status'        => 'string',
    'img_src'       => 'string',
    'description'   => 'string',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'id');
  }

  public function brand()
  {
    return $this->belongsTo(Brand::class, 'brand_id', 'id');
  }
}
