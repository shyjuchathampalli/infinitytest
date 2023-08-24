<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name','unit_type','product_category','product_price','discount_percentage','discount_amount','discount_start_date','discount_end_date','tax_percentage','tax_amount','stock_quantity'];

}
