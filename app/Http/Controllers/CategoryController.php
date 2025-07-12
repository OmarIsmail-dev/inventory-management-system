<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        
         $Categories=Category::all();
        return view("categtory.category",compact("Categories"));
    }

    
 
    public function CreateCategory(Request $request)
    {


        $check = category::where("name", $request->name)->get(); 
        if ($check->count() > 0) {
            return redirect()->back()->with('success', 'This category already exists!');
        }
   

     
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Category name is required.',
         ]);
        
        
     Category::create([

    "name"=>$request->name


     ]);   

     


     return redirect()->route("category");
        
  
    }

    public function DeleteCategory($id){ 

        $CategoryId=Category::find($id); 
         $CategoryId->delete();   
        
        return redirect()->route("category");
       
       
       
       
          }

          
          public function EditCategory($id)
          {
              
               $category=Category::find($id);
              return view("categtory.edit",compact("category"));
          }
      

          public function UpdateCategory($id,Request $request)
          {
              
            $category = Category::find($id);
            $category->update([
                'name' => $request->input('name'),
            ]);

 

              return redirect()->route("category");
          }





}
