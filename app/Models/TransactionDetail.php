<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    
    protected $table = 'transaction_detail';
    protected $fillable = ['detail_qty','detail_price','detail_subtotal','product_id','transaction_code'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
