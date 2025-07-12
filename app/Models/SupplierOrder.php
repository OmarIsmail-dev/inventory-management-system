<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierOrder extends Model
{


    protected $fillable = ['supplier_name','status','email','price','phone','Product_name','TotalAmount','quantity','date','time','user_id','order_id',"brand","size_shoes","size_clothes","color", "description"];

    public function product()
    {
    
        return $this->belongsTo(Product::class);
    
    }
  

    public function user()
    {
    
        return $this->belongsTo(User::class,"user_id");
    
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

 
}
