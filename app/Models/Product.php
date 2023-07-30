<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['product_code','product_name','product_stock','product_purchase','product_sell','product_status','suplier_id'];

    public function supliers(){
        return $this->belongsTo(Suplier::class,'suplier_id','id');
    }
}
