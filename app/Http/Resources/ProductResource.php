<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return 
        
        [
            'id' => $this->id,
            'title' => $this->title,
            'BuyingPrice' => $this->BuyingPrice,
            'SellingPrice' => $this->SellingPrice,
            'in_stock' => $this->in_stock, 
            'image' => url($this->image), 
            'category' => $this->category->name,
            "brand" => $this->brand,
            "size_clothes" => $this->size_clothes ,
            "size_shoes" => $this->size_shoes  ,
            "color" => $this->color,
            "description" => $this->description,   
            'category_id' => $this->category_id,
            'created_at' => $this->created_at->format("d-m-y"),
            
             ];
        
        ;
    }



}
