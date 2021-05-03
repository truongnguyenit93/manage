<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'product_type',
        'customer_type',
        'transportation_fee',
        'funds',
        'interest',
        'image',
        'name_fb_customer',
    ];

    public $timestamps = true;
}
