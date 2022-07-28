<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    public function order_detail(){
    	return $this->hasMany(OrderDetail::class);
    }

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }

    

}
