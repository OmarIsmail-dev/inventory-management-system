<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
         protected $fillable = ['Address','email','status', 'quantity', 'phone','image','user_id','category_id',"product_id" ,"brand","size_shoes","color","size_clothes"];
         public function product()
        {
 
            return $this->belongsTo(Product::class,"product_id");
 
        }
    
 
        public function user()
        {
            return $this->belongsTo(User::class,"user_id");
        }
     
        public function categories()
        {
            return $this->belongsTo(Category::class,"category_id");
        }
 
        public function supplierOrders()
        {
            return $this->belongsTo(SupplierOrder::class, 'order_id');
        }
 
    }
    
 