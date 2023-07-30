<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;
    
    protected $table = 'cart';
    protected $fillable = ['product_qty','product_subtotal','product_id','user_id'];

    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
