<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
 
        // $response = Http::get("https://ecommers.shop/api/CustomerOrder"); 
        // $orders = $response->successful() ? $response->json()['data'] : [];
              
 
        $orders = CustomerOrder::all();
        $total = $orders->count();
        $pending = $orders->where('status', 'pending')->count();
        $completed = $orders->where('status', 'completed')->count();
        $refused = $orders->where('status', 'refused')->count();

        // Refused Orders (from refusedOrders method)
        $refusedOrders = CustomerOrder::with(['user', 'product'])
            ->where('status', 'refused')
            ->get(['id', 'user_id', 'product_id', 'email', 'Address', 'phone', 'image'])
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'user_name' => $order->user->name ?? 'N/A',
                    'email' => $order->email,
                    'Address' => $order->Address,
                    'phone' => $order->phone,
                    'product_name' => $order->product->title ?? 'N/A',
                    'image' => $order->image,
                ];
            });

        return response()->json([
            'success' => true,
            'user_count' => User::count(),
            'total_orders' => $total, // From orderStats
            'pending_orders' => $pending,
            'completed_orders' => $completed,
            'refused_orders' => $refused,
            'refused_orders_details' => $refusedOrders, // From refusedOrders
            'order_revenue_stats' => $this->orderRevenueStats(), // Updated to use new revenue stats
            'total_products' => Product::count(),
            'products_by_category' => $this->getProductsByCategory(),
            'safety_stock_items' => $this->getSafetyStockItems(),
            'top_5_selling_products' => $this->getTopSellingProducts(),
        ]);
    }

    public function getWeeklyDailyRevenue()
    {
        return Order::join('products', 'orders.product_id', '=', 'products.id')
            ->whereDate('orders.created_at', '>=', now()->subDays(6)) // includes today
            ->selectRaw('DATE(orders.created_at) as date, SUM(orders.quantity * products.SellingPrice) as total')
            ->groupByRaw('DATE(orders.created_at)')
            ->orderBy('date')
            ->get();
    }

    public function getMonthlyWeeklyRevenue()
    {
        return Order::join('products', 'orders.product_id', '=', 'products.id')
            ->whereMonth('orders.created_at', now()->month)
            ->whereYear('orders.created_at', now()->year)
            ->selectRaw('YEARWEEK(orders.created_at, 1) as year_week, SUM(orders.quantity * products.SellingPrice) as total')
            ->groupBy('year_week')
            ->orderBy('year_week')
            ->get()
            ->map(function ($item) {
                // Convert year_week (like 202519) to readable week label
                $year = substr($item->year_week, 0, 4);
                $week = substr($item->year_week, 4);
                $date = \Carbon\Carbon::now()->setISODate($year, $week)->startOfWeek();
                return [
                    'week' => $date->format('Y-m-d'),
                    'total' => $item->total,
                ];
            });
    }

    public function orderRevenueStats()
    {
        return response()->json([
            'success' => true,
            'daily_revenue' => $this->getWeeklyDailyRevenue(),
            'weekly_revenue' => $this->getMonthlyWeeklyRevenue()
        ]);
    }

    public function getProductsByCategory()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->select('id', 'category_id', 'title', 'in_stock');
        }])->get();

        $result = [];

        foreach ($categories as $category) {
            $totalProducts = $category->products->count();
            $inStock = $category->products->sum('in_stock'); 
            $outOfStock = $category->products->where('in_stock', 0)->count();
            $topSeller = Order::where('status', 'completed')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->where('products.category_id', $category->id)
                ->select('products.title', DB::raw('SUM(orders.quantity) as total_sold'))
                ->groupBy('products.title')
                ->orderByDesc('total_sold')
                ->first();
            $result[$category->name] = [
                'total' => $totalProducts,
                'in_stock' => $inStock,
                'out_of_stock' => $outOfStock,
                'top_seller' => $topSeller ? $topSeller->title : null,
            ];
        }

        return $result;
    }

    public function getSafetyStockItems()
    {
        $threshold = 10;
        $lowStock = Product::where('in_stock', '<', $threshold)
            ->with('category:id,name')
            ->get(['id', 'title', 'in_stock']);

        return [
            'count' => $lowStock->count(),
            'items' => $lowStock->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'in_stock' => $item->in_stock,
                    'category_name' => $item->category->name ?? 'Unknown',
                ];
            })->all(),
        ];
    }

    public function getTopSellingProducts()
    {
        return Order::where('status', 'completed')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with(['product' => function ($query) {
                $query->select('id', 'title')->with('category:id,name');
            }])
            ->get()
            ->map(function ($order) {
                return [
                    'product_id' => $order->product_id,
                    'product_name' => optional($order->product)->title,
                    'total_sold' => $order->total_sold,
                    'category_name' => optional(optional($order->product)->category)->name ?? 'Unknown',
                ];
            });
    }
}
