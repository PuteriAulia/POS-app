<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOut extends Model
{
    use HasFactory;

    protected $table = 'products_out';
    protected $fillable = ['productOut_code','productOut_qty','productOut_date','productOut_info','product_id'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
