<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use App\Models\Order;
use App\Models\Worker;
use App\Models\Product;
use App\Models\PageMessage;
use Illuminate\Http\Request;
use App\Models\SupplierOrder;
use Carbon\Carbon;

use Psy\Readline\Hoa\Ustring;
use function Illuminate\Log\log;
use function Laravel\Prompts\alert;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use MathPHP\Statistics\Descriptive;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     
     public function index()
    {
         

        $users = Auth::user();
        $pieData = Product::selectRaw('category_id, COUNT(*) as total')
            ->groupBy('category_id')
            ->get()
            ->pluck('total', 'category_id');

        $response = Http::get('https://ecommers.shop/api/users');
        $UserCount = $response->successful() ? $response->json()['totalUser'] : [];

        $TotalPrice = Http::get("https://ecommers.shop/api/TotalAmountOrder");
        $price = $TotalPrice->successful() ? $TotalPrice->json()['TotalAmount'] : [];

        $order = Http::get("https://ecommers.shop/api/CustomerOrder"); 
        $orders = $order->successful() ? $order->json()['data'] : [];  
        
        $years = [];
        
        foreach ($orders as $order) {
            try {
                $date = Carbon::createFromFormat('d-m-y', $order['created_at']);
        
                 $year = $date->year < 2000 ? $date->year + 100 : $date->year;
        
                $years[] = $year;
            } catch (\Exception $e) {

            }
        }
        
        $uniqueYears = array_unique($years);
        sort($uniqueYears); 
        
        $OptionYears=$uniqueYears; 
        


        foreach ($orders as $order) {
            if ($order['order_status'] === 'completed' && isset($order['product_id'], $order['created_at'])) {
                $product = Product::find($order['product_id']);
                if ($product) {
                    $orderDate = Carbon::createFromFormat('d-m-y', $order['created_at']);
   
                    if (!$product->last_sold_at || $orderDate->gt($product->last_sold_at)) {
                        $product->last_sold_at = $orderDate;
                        $product->save();
                    }
                }
            }
        }

     
 
        $z = 2.32;

        $result = Http::get('https://ecommers.shop/api/std');
        $stds = $result->successful() ? $result->json() : []; 
       
 
        $SupplierOrder = SupplierOrder::all(); 
        $today = Carbon::today();
        $date = SupplierOrder::orderBy("date")->value("date");
        $someDate = Carbon::parse($date);
        $diffInDays = (int) $today->diffInDays($someDate);  
        $L=(int) sqrt($diffInDays);
  
        $products = Product::all()->keyBy('id');

        foreach ($stds as $std) {

            $productId = $std['product_id'];
        
            if (!isset($products[$productId])) continue;
        
            $product = $products[$productId];
            
            $safetyStock = $z * $std['std_daily_demand'] * $L;
            $rop = $safetyStock + ($std['mean_daily_demand'] * $L);
            $roundedRop = (int) round($rop);
  
            $warnings = [];

            foreach ($products as $product) {
                $inStock = (int) $product->in_stock;
                $rop = (int) $roundedRop;
            
                if ($inStock <= $rop && auth()->user()->role === 'Manager') {
                    $product_name = $product->title;
                    $warnings[] = "⚠️ Stock alert: Please restock \"$product_name\" from the supplier.";
                }
            }
            
            // بعد اللوب
            if (!empty($warnings)) {
                session()->flash('warnings', $warnings);
            }
            
                                
        }

        function getBaseModelName($productName)
        {
            return strtolower(preg_replace('/[^a-z0-9]/i', '', explode(' ', $productName)[0] . (explode(' ', $productName)[1] ?? '')));
        }
        
        $currentSeason = Product::getCurrentSeason(); // استخدم الدالة هنا
        $currentYear = now()->year;
        $warnings = [];
        $warnedProducts = []; // Array to keep track of products already warned about
        
        $products = Product::where('in_stock', '>', 0)->get();
        
        foreach ($products as $product) {
            if (auth()->user()->role !== 'Manager') continue;
        
            // Get the base model name
            $baseModelName = getBaseModelName($product->title);
        
            // Skip the product if it has already been warned about
            if (in_array($baseModelName, $warnedProducts)) {
                continue;
            }
        
            // Handle seasonal products (e.g., clothing or shoes)
            if ($product->product_type === 'seasonal') {
                $season = ucfirst(strtolower(trim($product->product_attribute_value)));
        
                $isActive = $season === $currentSeason;
        
                if (!$isActive || ($product->last_sold_at && $product->last_sold_at->lt(now()->subMonths(3))))
                {
                    $warnings[] = "👕 Stagnant seasonal product: \"{$baseModelName}\" is not in season and hasn't sold in over 3 months.";
                    $warnedProducts[] = $baseModelName; // Mark as warned
                }
            }
        
            // Handle production-based products (e.g., electronics)
            if ($product->product_type === 'production') {
                $year = (int) $product->product_attribute_value;
        
                $isActive = $year >= ($currentYear - 1);
        
                if (!$isActive) {
                    $warnings[] = "📱 Old product: \"{$baseModelName}\" is an outdated model and still in stock.";
                    $warnedProducts[] = $baseModelName; // Mark as warned
                }
            }
        }
        
        if (!empty($warnings)) {
            session()->flash('warnings', $warnings);
        }


        // $currentSeason = Product::getCurrentSeason();  
        //  $currentYear = now()->year;
        // $warnings = [];
    
        // $products = Product::where('in_stock', '>', 0)->get();
    
        // foreach ($products as $product) {
        //     if (auth()->user()->role !== 'Manager') continue;


        //     $baseModelName = getBaseModelName($product->title);


        //     // Handle seasonal products (e.g., clothing or shoes)
        //     if ($product->product_type === 'seasonal') {
        //         $season = ucfirst(strtolower(trim($product->product_attribute_value)));
    
        //         $isActive = $season === $currentSeason;
    
        //         if (!$isActive && $product->last_sold_at && $product->last_sold_at->lt(now()->subMonths(3))) {
        //             $warnings[] = "👕 Stagnant seasonal product: \"{$baseModelName}\" is not in season and hasn't sold in over 3 months.";
        //         }
        //     }
    
        //     // Handle production-based products (e.g., electronics)
        //     if ($product->product_type === 'production') {
        //         $year = (int) $product->product_attribute_value;
    
        //         $isActive = $year >= ($currentYear - 1);
    
        //         if (!$isActive) {
        //             $warnings[] = "📱 Old product: \"{$baseModelName}\" is an outdated model and still in stock.";
        //         }
        //     }
        // }
    
        // if (!empty($warnings)) {
        //     session()->flash('warnings', $warnings);
        // }

                 
  return view('home', compact("users", "pieData", "UserCount", "price" ,"L","z","orders","stds","OptionYears"));
  
 
    }

    public function getCustomerOrders(Request $request)
{
    $year = $request->query('year', now()->year);

     $orders = Http::get("https://ecommers.shop/api/CustomerOrder", [
        'created_at' => $year
    ]);


    return $orders->json(); // رجع البيانات الجاية من الـAPI
}


  




    public function RequestSupplier()
    {

        $orders = Order::all();
        $SupplierOrders = SupplierOrder::with("order")->get();
        $products = Product::all();


        return view("RequestSupplier", compact("SupplierOrders", "orders", "products"));

    }







    public function createMessage(Request $request)
    {

        PageMessage::create([
            'user_id' => auth()->user()->id,
            'title' => $request->input("title"),
            'message' => $request->input("message"),
            'type' => $request->input("type"),
            'AssignedTo' => $request->input("AssignedTo"),


        ]);



        return redirect()->route("MessageAdmin")->with("success", "message sent successfully🥳");

    }

    public function MessageAdmin()
    {

        $users = User::all();
        $messages = PageMessage::with("user")->get();
        return view("MessageAdmin", compact("messages", "users"));

    }


    public function MessageWorker()
    {
        $users = User::all();
        $messages = PageMessage::with("user")->get();

        return view("Worker.MessageWorker", compact("messages", "users"));
    }

    public function MessageSupplier()
    {

        $users = User::all();
        $messages = PageMessage::with("user")->get();
        return view("supplier.MessageSupplier", compact("messages", "users"));
    }

    public function MessageManager()
    {
        $users = User::all();
        $messages = PageMessage::with("user")->get();

        return view("Manager.MessageManager", compact("messages", "users"));
    }

    public function MediaFiles()
    {
        return view("MediaFiles");
    }



    public function Logout(Request $request)
    {
        auth()->user()->update(['last_active_at' => null]);
        auth()->logout();

        // Optional: Invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login")->with('success', 'تم تسجيل خروجك بنجاح!');
    }


    public function AcceptableRequests()
    {

        $SupplierOrders = SupplierOrder::orderByRaw("status = 'Waiting' DESC")->with("order")
            ->get();

        $checkOrder = SupplierOrder::whereNotIn('status', ['pending', 'refused'])->get();
        $users = SupplierOrder::where('user_id', auth()->id())->get();
        $products = Product::all();



        // dd($checkOrder);

        return view("AcceptableRequests", compact("SupplierOrders", "checkOrder", "products"));
    }
    public function AddOrder()
    {

        $products = Product::with("category")->get();
        $orders = Order::all();

        return view("order.AddOrder", compact("products", "orders"));

    }

    public function Order()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view("order.order", compact("orders"));
    }


    public function CreateOrder(Request $request)
    {

        $request->validate(
            [
                'phone' => 'required|numeric|digits_between:10,15',
                'email' => 'required|email|max:255',
                'quantity' => 'required|integer|min:1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
                "Address" => "required|string|max:255",

            ],

            [
                'phone.required' => 'Phone number is required.',
                'phone.numeric' => 'Phone number must be numeric.',
                'email.required' => 'Email address is required.',
                'email.email' => 'Please enter a valid email address.',
                'quantity.required' => 'Please enter the quantity.',
                'quantity.integer' => 'Quantity must be an integer.',
                'image.image' => 'The uploaded file must be an image.',
                'Address.required' => 'Address is required.',

            ]
        );



        $createImg = $request->except("image");
        if ($request->hasFile("image")) {
            $image = $request->image;
            $oldImage = $image->getClientOriginalName();
            $newimage = uniqid() . $oldImage;
            $image->move("image", $newimage);
            $imgUrl = "image/$newimage";
            $createImg['image'] = $imgUrl;
        }

        $order = Order::create([

            "user_id" => $request->input("user_id"),
            "product_id" => $request->input("product_id"),
            "phone" => $request->input("phone"),
            "email" => $request->input("email"),
            "quantity" => $request->input("quantity"),
            "image" => $imgUrl,
            "Address" => $request->input("Address"),
            "size_clothes" => $request->size_clothes,
            "size_shoes" => $request->size_shoes,
            "color" => $request->color,
            "description" => $request->description,


        ]);



        return Redirect()->route("Order")->with('success', 'order create successfully!');
    }


    public function DeleteOrder($id)
    {

        $orderId = Order::find($id);
        $orderId->delete();

        return redirect()->route("Order")->with("success", "Your {$orderId->product->title} has been deleted");

    }
    public function EditOrder($id)
    {
        $order = Order::find($id);
        $products = Product::with("category")->get();

        return view("order.editorder", compact("order", "products"));
    }




    public function UpdateOrder($id, Request $request)
    {

        $request->validate(
            [
                'phone' => 'required|numeric|digits_between:10,15',
                'email' => 'required|email|max:255',
                'quantity' => 'required|integer|min:1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
                "Address" => "required|string|max:255",

            ],

            [
                'phone.required' => 'Phone number is required.',
                'phone.numeric' => 'Phone number must be numeric.',
                'email.required' => 'Email address is required.',
                'email.email' => 'Please enter a valid email address.',
                'quantity.required' => 'Please enter the quantity.',
                'quantity.integer' => 'Quantity must be an integer.',
                'image.image' => 'The uploaded file must be an image.',
                'Address.required' => 'Address is required.',

            ]
        );



        $createImg = $request->except("image");
        if ($request->hasFile("image")) {
            $image = $request->image;
            $oldImage = $image->getClientOriginalName();
            $newimage = uniqid() . $oldImage;
            $image->move("image", $newimage);
            $imgUrl = "image/$newimage";
            $createImg['image'] = $imgUrl;
        }


        $order = Order::find($id);
        $order->update([
            "phone" => $request->input("phone"),
            "email" => $request->input("email"),
            "quantity" => $request->input("quantity"),
            'image' => $imgUrl ?? $order->image,
            "Address" => $request->input("Address"),
            "size_clothes" => $request->size_clothes,
            "size_shoes" => $request->size_shoes,
            "brand" => $request->brand,
            "color" => $request->color,
            "description" => $request->description,

        ]);


        return redirect()->route("Order")->with('success', 'order updated successfully!');


    }


    public function refusedRequest()
    {
        $SupplierOrders = SupplierOrder::orderBy('created_at', 'desc')->with("order")->get();
        $checkOrder = SupplierOrder::whereNotIn('status', ['Waiting', 'completed'])->get();
        $users = SupplierOrder::where('user_id', auth()->id())->get();
        return view("refusedRequest", compact("SupplierOrders", "checkOrder"));

    }


    public function WorkerOrder()
    {
        $workers = User::all();
        $orders = Order::with("product")->get();
        $SupplierOrder = SupplierOrder::whereIn('status', ["pending"])->first();
        $SupplierOrders = SupplierOrder::with('order.product')->get();


        return view("Manager.WorkerOrder", compact("workers", "orders", "SupplierOrder", "SupplierOrders"));
    }


    public function assignTask(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            "supplier_order_id" => 'required',
            'description' => 'nullable|string',
        ]);


        // Create the task
        $task = Task::create([
            'title' => "null",
            'description' => $request->description,
            'status' => 'pending',
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'supplier_order_id' => $request->supplier_order_id,
            'manager_name' => $request->manager_name,
            'problem' => $request->problem ?? null,

        ]);




        return back()->with('success', 'Task assigned successfully!');
    }

    public function Task()
    {

        $tasks = Task::with("user")->get();
        $products = Product::all();
        return view("Manager.task", compact("tasks", "products"));

    }


    public function WorkerTask()
    {
        $SupplierOrders = SupplierOrder::orderByRaw("status = 'Waiting' DESC")->with("order")->get();
        $tasks = Task::orderByRaw("status = 'Pending' DESC")->orderBy('created_at', 'desc')->with("user", "order", "supplierOrder")->get();
        $SupplierOrders = SupplierOrder::all();

        $check = Task::whereNotIn('status', ['refused', 'completed'])->first();
        $products = Product::all();




        return view("Worker.workertask", compact("tasks", "check", "SupplierOrders", "products"));

    }

    public function TaskDone($id, Request $request)
    {
        $task = Task::with("supplierOrder")->findOrFail($id);
        // if ($request->hasFile('proof')) {
        //     $filePath = $request->file('proof')->store('task_proofs', 'public');
        //     $task->proof = $filePath;
        //     $task->save();
        // }

 
        $Orders = Order::find($task->order_id);  
        $SupplierOrders = SupplierOrder::where('id', $task->supplier_order_id)->first();
        
        if ($Orders && $SupplierOrders) {
            DB::transaction(function () use ($task, $Orders, $SupplierOrders) {
                $task->update(['status' => 'completed']);
                $Orders->update(['status' => 'completed']);
                $SupplierOrders->update(['status' => 'completed']);
                $product = Product::find($SupplierOrders->order->product_id);
                if ($product) {
                    $productIn_stock = $product->in_stock + $SupplierOrders->quantity;
                    $product->update(['in_stock' => $productIn_stock]);
                }
            });
        }



        return redirect()->back()->with('success', 'Received successfully');


    }


    public function submitProblem(Request $request, $id)
    {

        $task = Task::findOrFail($id);

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('task_proofs', 'public');
        //     $task->image = $imagePath;
        //     $task->save();
        // }

        $Orders = Order::find($task->order_id);
        $SupplierOrders = SupplierOrder::where('id', $task->supplier_order_id)->first();

        if ($Orders && $SupplierOrders) {
            DB::transaction(function () use ($task, $Orders, $SupplierOrders) {
                $task->update(['status' => 'refused']);
                $Orders->update(['status' => 'refused']);
                $SupplierOrders->update(['status' => 'refused']);
            });
        }


        return redirect()->back()->with('error', 'The request has been rejected!');

    }





}
