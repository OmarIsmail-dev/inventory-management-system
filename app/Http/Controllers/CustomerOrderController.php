<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\CustomerOrder;

class CustomerOrderController extends Controller
{
   public function CustomerOrder()
    {
        $orders = CustomerOrder::all();
        return view("customerorder", compact("orders"));
    }

    public function search(Request $request)
    {
        $searchTerm = trim($request->query('search'));
        $orders = [];

        if ($searchTerm) {
            $allOrders = CustomerOrder::all();
            $orders = array_filter($allOrders->toArray(), function ($order) use ($searchTerm) {
                return stripos($order['id'], $searchTerm) !== false ||
                       stripos($order['user_name'], $searchTerm) !== false ||
                       stripos($order['product_name'], $searchTerm) !== false ||
                       stripos($order['status'], $searchTerm) !== false;
            });
        } else {
            return redirect()->route("CustomerOrder")->with("error", "Search bar is empty?!");
        }

        return view("search", ['orders' => array_values($orders)]);
    }

    public function orderStats()
    {
        $orders = CustomerOrder::all();

        $total = $orders->count();
        $pending = $orders->where('status', 'pending')->count();
        $completed = $orders->where('status', 'completed')->count();
        $refused = $orders->where('status', 'refused')->count();

        return response()->json([
            'success' => true,
            'total_orders' => $total,
            'pending_orders' => $pending,
            'completed_orders' => $completed,
            'refused_orders' => $refused,
        ]);
    }
    public function refusedOrders()
    {
        $orders = CustomerOrder::with(['user', 'product']) // Eager load both relations
            ->where('status', 'refused')
            ->get(['id', 'user_id', 'product_id', 'email', 'Address', 'phone', 'image']);

        // Transform results
        $transformed = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'user_name' => $order->user->name ?? 'N/A',
                'email' => $order->email,
                'Address' => $order->Address,
                'phone' =>$order->phone,
                'product_name' => $order->product->title ?? 'N/A', // adjust if your products table uses a different column name
                'image' => $order->image,
            ];
        });

        return response()->json([
            'success' => true,
            'orders' => $transformed,
        ]);
    }

}

