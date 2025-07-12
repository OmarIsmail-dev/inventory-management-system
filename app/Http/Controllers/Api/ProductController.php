<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Resource_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
 
        $products = Product::all();
        return  ProductResource::collection($products);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $product = Product::find($id);
    
         if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
         return new ProductResource($product);
    }
                 

 
    /**
     * Update the specified resource in storage.
     */
 
    //  public function updateStock(Request $request, string $id)
    // { 
    //  $request->validate([
    //     'quantity' => 'required|integer|min:1',  
    // ]);

    //   $product = Product::find($id);

    //  if (!$product) {
    //     return response()->json(['message' => 'Product not found'], 404);
    // }

    //  if ($product->in_stock < $request->quantity) {
    //     return response()->json(['message' => 'Not enough stock'], 400);
    // }

    //  $newStock = $product->in_stock - $request->quantity;
    // $product->update(['in_stock' => $newStock]);

  
    //     return new ProductResource($product);
    
    // }

 
    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        $product = Product::find($id);

        $NewStock=  $product->in_stock - $request->quantity;
        $product->update(['in_stock' =>$NewStock ]);
    
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        if ($product->in_stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock'], 400);
        }
     


        return response()->json(['message' => 'Stock updated', 'in_stock' => $product->in_stock]);
    }
      
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
