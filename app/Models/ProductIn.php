<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductIn extends Model
{
    use HasFactory;

    protected $table = 'products_in';
    protected $fillable = ['productIn_code','productIn_qty','productIn_date','productIn_info','product_id'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
