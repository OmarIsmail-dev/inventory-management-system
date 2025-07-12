<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 

    public function index()
    {
 
        $Category = category::all();
        return  CategoryResource::collection($Category);
        
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
         $category = category::find($id);
    
         if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }
    
         return new CategoryResource($category);
    }
                 

 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         
         



      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
