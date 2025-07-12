<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product()
    {


        $products = Product::with("category")->get("*");



        return view("product.product", compact("products"));

    }


    public function AddProduct()
    {

        $categories = category::all();

        return view("product.AddProduct", compact("categories"));

    }


    public function CreateProduct(Request $request)
    {


        $category_id = $request->category_id;
        $title = $request->title;
        $color = $request->color;

        $category = Category::find($category_id);
        
        if (!$category) {
            return redirect()->back()->with('error', 'Invalid category selected.');
        }
        
        $query = Product::where('title', $title)
            ->where('color', $color);
        
        if (strtolower($category->name) === 'shoes') {
            $query->where('size_shoes', $request->size_shoes);
        } elseif (strtolower($category->name) === 'clothing') {
            $query->where('size_clothes', $request->size_clothes);
        }
        
        $check = $query->get();
        
 
        if ($check->count() > 0) {
            return redirect()->back()->with('error', 'This Product already exists!');
        }

 
        $createImg = $request->except("image");
        if ($request->hasFile("image")) {
            $image = $request->image;
            $oldImage = $image->getClientOriginalName();
            $newimage = uniqid() . $oldImage;
            $image->move("image", $newimage);
            $imgUrl = "image/$newimage";
            $createImg['image'] = $imgUrl;
        }



        $validated = $request->validate(
            [
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'in_stock' => 'required|integer|min:0',
                'BuyingPrice' => 'required|numeric|min:0',
                'SellingPrice' => 'required|numeric|min:0', 
                'brand' => 'nullable|string|max:255',
                'color' => 'nullable|string|max:255',
                     
            ], 
            [ 
                'category_id.required' => 'You must choose a classification.',
                'category_id.exists' => 'Classification is incorrect.',
               
                ]
        );


  Product::create([ 

            'title' => $request->title,
            'category_id' => $request->category_id,
            'in_stock' => $request->in_stock,
            'BuyingPrice' => $request->BuyingPrice,
            "brand" => $request->brand,
            "size_clothes" => $request->size_clothes ,
            "size_shoes" => $request->size_shoes  ,
            "color" => $request->color,
            "description" => $request->description,  
            'SellingPrice' => $request->SellingPrice,
            'product_attribute_value' => $request->product_attribute_value,
            'image' => $imgUrl 

        ]);


        return redirect()->route("product")->with('success', 'product create successfully!');


    }

    public function DeleteProduct($id)
    {

        $ProductId = Product::find($id); 
        $ProductId->delete();

        return redirect()->route("product")->with("success", "Your $ProductId->title has been deleted");




    }


    public function EditProduct($id)
    {

        $categories = category::all();
        $product = Product::find($id); 

        return view("product.EditProduct", compact("categories", "product"));

    }


    public function UpdateProduct($id, Request $request)
    { 

        $category_id = $request->category_id;
        $title = $request->title;
        $color = $request->color;

        $category = Category::find($category_id);
        
        if (!$category) {
            return redirect()->back()->with('error', 'Invalid category selected.');
        }
        
        $query = Product::where('title', $title)
            ->where('color', $color);
        
        if (strtolower($category->name) === 'shoes') {
            $query->where('size_shoes', $request->size_shoes);
        } elseif (strtolower($category->name) === 'clothing') {
            $query->where('size_clothes', $request->size_clothes);
        }
        
        $check = $query->get();
        
 
        if ($check->count() > 0) {
            return redirect()->back()->with('error', 'This Product already exists!');
        }

        $product = Product::find($id);
        $createImg = $request->except("image");
        if ($request->hasFile("image")) {
            $image = $request->image;
            $oldImage = $image->getClientOriginalName();
            $newimage = uniqid() . $oldImage;
            $image->move("image", $newimage);
            $imgUrl = "image/$newimage";
            $createImg['image'] = $imgUrl;
        }



        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'in_stock' => 'required|integer|min:0',
            'BuyingPrice' => 'required|numeric|min:0',
            'SellingPrice' => 'required|numeric|min:0',
             'color' => 'required|string|max:10',
            //  'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'brand' => ' nullable|string|max:255',
        ], [
            'category_id.required' => 'You must choose a classification.',
            'category_id.exists' => 'Classification is incorrect.',
     
        ]);


        $product->update([
            'title' => $request->input("title"),
            'category_id' => $request->input("category_id"),
            'in_stock' => $request->input("in_stock"),
            'BuyingPrice' => $request->input("BuyingPrice"),
            'SellingPrice' => $request->input("SellingPrice"),
            "brand" => $request->brand,
            "size_clothes" => $request->size_clothes ,
            "size_shoes" => $request->size_shoes ,
            "color" => $request->color,
            "description" => $request->description,     
            'product_attribute_value' => $request->product_attribute_value,
            'image' => $imgUrl ?? $product->image

        ]);

     

        return redirect()->route("product")->with('success', 'product updated successfully!');


    }






}
