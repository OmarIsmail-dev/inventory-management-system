<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
         public function category()
        {
            return $this->belongsTo(Category::class,"category_id");
        }
 
     
         public function supplier_order()
        {
            return $this->belongsTo(SupplierOrder::class);
        }

        public function orders()
        {
            return $this->belongsToMany(CustomerOrder::class);
        }


        protected $fillable = [
            
            'title',
            'image',
            'in_stock',
            'BuyingPrice',
            'SellingPrice',
            'category_id',
            "brand",
            "size_shoes",
            "size_clothes",  
            "color", 
            "product_type",
            "product_attribute_name",
            "product_attribute_value",
            "is_active_model", 
           "description"
        ];

        protected $casts = [
            'last_sold_at' => 'datetime',
        ];
 

        protected static function booted()
        {
            static::saving(function ($product) {

                if (!$product->category_id || !$product->category) {
                    return;
                }
    
                $categoryName = strtolower($product->category->name);
    
                if (in_array($categoryName, ['shoes', 'clothing'])) {
                    $product->product_type = 'seasonal';
                    $product->product_attribute_name = 'season';
                } elseif (in_array($categoryName, ['electronics'])) {
                    $product->product_type = 'production';
                    $product->product_attribute_name = 'production_year';
                } else {
                    $product->product_type = 'other';
                    $product->product_attribute_name = 'custom';
                }
    
    
                $now = Carbon::now();  

                  $product->product_attribute_value = $product->product_attribute_value
    ? ucfirst(strtolower(trim($product->product_attribute_value)))
    : null;

                if ($product->product_type === 'production') {
                    $product->is_active_model = in_array((int) $product->product_attribute_value, [$now->year, $now->year - 1]);
                }
                
                if ($product->product_type === 'seasonal'){
                    $currentSeason = match (true) {
                        $now->month >= 3 && $now->month <= 9 => 'Summer',
                        default => 'Winter',
                    };
                
                    $product->is_active_model = $product->product_attribute_value === $currentSeason;
                }
                
                
            });
        }
    

 
public static function getCurrentSeason(): string
{

    $month = now()->month;
    return ($month >= 3 && $month <= 9) ? 'Summer' : 'Winter';

}


    }
    
