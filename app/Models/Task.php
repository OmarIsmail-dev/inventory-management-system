<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
 
    protected $fillable = ['supplier_order_id','title', 'description', 'status', 'user_id','manager_name','problem',"image","order_id"]; 
 
    public function supplierOrder()
    {
        return $this->belongsTo(SupplierOrder::class, 'supplier_order_id');
    }
   public function user() { 

        return $this->belongsTo(User::class,"user_id");
 
     }

    public function order() {

        return $this->belongsTo(Order::class,"order_id");
   

    }

    public function manager() {

        return $this->belongsTo(Manager::class);

    }

    
}
