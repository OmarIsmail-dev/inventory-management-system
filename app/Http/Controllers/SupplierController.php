<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class SupplierController extends Controller
{


   public function SupplierOrder()
   {
      $SupplierOrders = SupplierOrder::with("order")->get();
      $products = Product::all();

      $Products = Product::with('category')
      ->whereHas('category', function ($query) {
          $query->where('name', auth()->user()->supplierType);
      })
      ->get();

   $orders = Order::with(['product.category', 'user'])
      ->whereHas('product.category', function ($query) {
          $query->where('name', auth()->user()->supplierType);
      })
      ->where('status', '!=', 'completed')
      ->get();      


      return view("supplier.SupplierOrder", compact("SupplierOrders", "products","orders"));
   }




   public function Requests()
   {
        $Products = Product::with('category')
           ->whereHas('category', function ($query) {
               $query->where('name', auth()->user()->supplierType);
           })
           ->get();
   
        $orders = Order::with(['product.category', 'user'])
           ->whereHas('product.category', function ($query) {
               $query->where('name', auth()->user()->supplierType);
           })
           ->where('status', '!=', 'completed')
           ->get();
   
       return view('supplier.Requests', compact('orders', 'Products'));
   }
   



   public function AddRequests()
   {

      $Products = Product::with('category')
      ->whereHas('category', function ($query) {
          $query->where('name', auth()->user()->supplierType);
      })
      ->get();

   $orders = Order::with(['product.category', 'user'])
      ->whereHas('product.category', function ($query) {
          $query->where('name', auth()->user()->supplierType);
      })
      ->where('status', '!=', 'completed')
      ->get();      
      
 
      return view("supplier.AddRequests", compact("orders","Products"));


   }


   public function createRequests(Request $request)
   {


      $request->validate([
         "supplier_name" => "required|string|max:255",
         "email" => "required|email|max:255",
         "phone" => "required|numeric",
         "quantity" => "required|integer|min:1",
         "date" => "required|date",
         "time" => "required|date_format:H:i",
         "price" => "required|numeric|min:0",
          'brand' => 'nullable|string|max:255',           
         'color' => 'required|string|max:10',
         // 'description' => 'nullable|string|max:1000',


      ], [
         'supplier_name.required' => 'Please enter the supplier name.',
         'email.required' => 'Email address is required.',
         'email.email' => 'Please enter a valid email address.',
         'phone.required' => 'Phone number is required.',
         'phone.numeric' => 'Phone number must be numeric.',
         'quantity.required' => 'Please enter the quantity.',
         'quantity.integer' => 'Quantity must be an integer.',
         'date.required' => 'Date is required.',
         'date.date' => 'Please enter a valid date.',
         'time.required' => 'Time is required.',
         'time.date_format' => 'Please enter the time in HH:MM format.',
         'price.required' => 'Price is required.',
         'price.numeric' => 'Price must be a valid number.', 
          'color.string' => 'Allowed color are: red blue.', 
         // 'description.max' => 'Description must be less than 1000 characters.',
         'brand.string ' =>'brand is string.'


      ]);


      SupplierOrder::create([

         "supplier_name" => $request->input("supplier_name"),
         "order_id" => $request->input("order_id"),
         "user_id" => $request->input("user_id"),
         "email" => $request->input("email"),
         "phone" => $request->input("phone"),
         "quantity" => $request->input("quantity"),
         "date" => $request->input("date"),
         "time" => $request->input("time"),
         "price" => $request->input("price"),
         "TotalAmount" => $request->input("TotalAmount"),
         "size_clothes" => $request->size_clothes ,
         "size_shoes" => $request->size_shoes ,
         "color" => $request->color,
         "description" => $request->description, 
         "brand" => $request->brand,


      ]);

      return redirect()->route("SupplierOrder")->with('success', 'order create successfully!');
      ;

   }

   public function acceptOffer($id)
   { 
      $supplierOrder = SupplierOrder::find($id);
      $existingOrder = SupplierOrder::where('order_id', $supplierOrder->order_id)
      ->whereIn('status', ['Waiting', 'completed'])
      ->where('id', '!=', $id)
      ->first();

   if ($existingOrder) {
      return back()->with('error', 'You have accepted the same name request before!');
   }
    
   $offer = SupplierOrder::findOrFail($id);     
       $offer->status = 'Waiting';
       $offer->save(); 
        return redirect()->route("RequestSupplier", ['id' => $offer->id])->with('success', 'The offer has been successfully accepted🥳');
   }

   public function StatusWaiting($id, Request $request)
   {

      $order = Order::find($id); 
      $supplierOrder = SupplierOrder::find($id);
      $existingOrder = SupplierOrder::where('order_id', $supplierOrder->order_id)
      ->whereIn('status', ['Waiting', 'completed'])
      ->where('id', '!=', $id)
      ->first();

   if ($existingOrder) {
      return back()->with('error', 'You have accepted the same name request before!');
   }

      $selectedOffer = SupplierOrder::findOrFail($id); 
      $orderId = $selectedOffer->order_id;       
      $allOffers = SupplierOrder::where('order_id', $orderId)->get();  
      $bestOffer = $allOffers->sortBy(function ($offer) {
          return sprintf(
              '%015.2f-%s-%010d',
              $offer->TotalAmount,
              Carbon::parse($offer->date . ' ' . $offer->time)->format('YmdHis'),
              -$offer->quantity
          );
      })->first();
  
       if ($selectedOffer->id !== $bestOffer->id) {
          return redirect()->route("RequestSupplier")
              ->with('warning', 'There is a better offer than the one you selected. Do you want to continue ?')
              ->with('offer_id', $selectedOffer->id);
      }  

      
      else {

         $supplierOrder->update([
            "status" => "Waiting"
         ]); 
      }

 
        return redirect()->route("RequestSupplier")->with('success', 'The offer has been successfully accepted🥳');


   }


   public function StatusFailed($id, Request $request)
   { 
      $SupplierOrders = SupplierOrder::find($id); 
      $SupplierOrders->update([
         "status" => "refused"
      ]); 

      return  redirect()->route("refusedRequest")->with("success","The request was rejected."); 

   }


   public function deleteRequests($id)
   { 
      $SupplierOrderId = SupplierOrder::findOrFail($id);
      $now = Carbon::now();
      $deliveryTime = Carbon::parse($SupplierOrderId->date);    
      if ($deliveryTime->diffInHours($now) < 24) { 
         return redirect()->route("SupplierOrder")->with("error", "This order can no longer be modified because it has less than 24 hours left for delivery."); 
      }

      $SupplierOrderId->delete();
      $products = Product::all();




      foreach ($products as $product) {
         if ($product->id === $SupplierOrderId->order->product_id) {

            return redirect()->route("SupplierOrder")->with("success", "Your {$product->title} has been deleted");
             

         }

      }

   }

   public function editRequests($id)
   {
      $orders = Order::with("product", "user")->get();

      $supplierOrder = SupplierOrder::findOrFail($id); 
      $now = Carbon::now();
      $deliveryTime = Carbon::parse($supplierOrder->date);

      
      if ($deliveryTime->lessThanOrEqualTo(now()->addHours(24))) {
         return redirect()->route("SupplierOrder")->with("error", "This order can no longer be modified because it has less than 24 hours left for delivery."); 
      }


      return view("supplier.editorder", compact("orders", "supplierOrder"));

   }

   public function updateRequests($id, Request $request)
   {

      
      $supplierOrders = SupplierOrder::findOrFail($id); 

       $supplierOrders->update([
         "email" => $request->input("email"),
         "phone" => $request->input("phone"),
         "supplier_name" => $request->input("supplier_name"),
         "quantity" => $request->input("quantity"),
         "date" => $request->input("date"),
         "time" => $request->input("time"),
         "price" => $request->input("price"),
         "TotalAmount" => $request->input("TotalAmount"),
         "size_clothes" => $request->size_clothes ,
         "size_shoes" => $request->size_shoes ,
         "color" => $request->color,
         "description" => $request->description, 
         "brand" => $request->brand,


      ]);

      return redirect()->route("SupplierOrder")->with('success', 'order updated successfully!');
 
   }


   public function AcceptableSupplier()
   {

      $SupplierOrders = SupplierOrder::orderByRaw("status = 'Waiting' DESC")->with("order")  
      ->get(); 
      $checkOrder = SupplierOrder::whereNotIn('status', ['pending', 'refused'])->get();
      $users = SupplierOrder::where('user_id', auth()->id())->get();
      $products = Product::all();  
      return view("supplier.AcceptableSupplier", compact("SupplierOrders", "checkOrder", "products", "users"));
   }

   public function refusedSupplier()
   {

      $SupplierOrders = SupplierOrder::orderBy('created_at', 'desc')->with("order")  
      ->get();
      
      $checkOrder = SupplierOrder::where('status', ['refused'])->first();
      $users = SupplierOrder::where('user_id', auth()->id())->get();

      return  view("supplier.refusedSupplier", compact("SupplierOrders", "checkOrder", "users"));
   }


}
