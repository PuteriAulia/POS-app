<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $fillable = ['transaction_code','transaction_date','transaction_total','transaction_disc','transaction_grand_total','user_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
