<?php
 
use App\Http\Controllers\HomeController;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view("auth.login");
});

 
Auth::routes();

Route::middleware("auth")->group(function(){

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'product'])->name('product');
Route::get('/CustomerOrder', [App\Http\Controllers\CustomerOrderController::class, 'CustomerOrder'])->name('CustomerOrder');
Route::get('/order', [App\Http\Controllers\HomeController::class, 'Order'])->name('Order');
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'category'])->name('category');
Route::get('/report', [App\Http\Controllers\HomeController::class, 'report'])->name('report');
Route::get('/MediaFiles', [App\Http\Controllers\HomeController::class, 'MediaFiles'])->name('MediaFiles');
Route::get('/SupplierOrder', [App\Http\Controllers\SupplierController::class, 'SupplierOrder'])->name('SupplierOrder');
Route::get('/users', [App\Http\Controllers\usersController::class, 'users'])->name('users'); 
Route::get('/Addusers', [App\Http\Controllers\usersController::class, 'AddUsers'])->name('AddUsers');
Route::post('/createusers', [App\Http\Controllers\usersController::class, 'CreateUsers'])->name('CreateUsers');
Route::get('/Logout', [App\Http\Controllers\HomeController::class, 'Logout'])->name('Logout');
Route::get('/DeleteUser/{id}', [App\Http\Controllers\usersController::class, 'DeleteUser'])->name('DeleteUser');
Route::get('/edituser/{id}', [App\Http\Controllers\usersController::class, 'EditUser'])->name('EditUser'); 
Route::put('/updateuser/{id}', [App\Http\Controllers\usersController::class, 'UpdateUser' ])->name("updateuser");
Route::get('/Logout', [App\Http\Controllers\HomeController::class, 'Logout'])->name('Logout');
Route::get('/DeleteProduct/{id}', [App\Http\Controllers\ProductController::class, 'DeleteProduct'])->name("DeleteProduct"); 
Route::get('/editproduct/{id}', [App\Http\Controllers\ProductController::class, 'EditProduct'])->name("editproduct"); 
Route::put('/updateproduct/{id}', [App\Http\Controllers\ProductController::class, 'UpdateProduct'])->name("UpdateProduct");
Route::get('/addproduct', [App\Http\Controllers\ProductController::class, 'AddProduct'])->name("addProduct");
Route::get('/DeleteCategory/{id}', [App\Http\Controllers\CategoryController::class, 'DeleteCategory'])->name("DeleteCategory");
Route::get('/editcategory/{id}', [App\Http\Controllers\CategoryController::class, 'EditCategory'])->name("editcategory"); 
Route::put('/updatecategory/{id}', [App\Http\Controllers\CategoryController::class, 'UpdateCategory'])->name("updatecategory"); 
Route::post('/createCategory', [App\Http\Controllers\CategoryController::class, 'CreateCategory'])->name('CreateCategory'); 
Route::post('/CreateProduct', [App\Http\Controllers\ProductController::class, 'CreateProduct'])->name("CreateProduct");
Route::get('/Requests', [App\Http\Controllers\SupplierController::class, 'Requests'])->name("Requests");
Route::get('/RequestSupplier', [App\Http\Controllers\HomeController::class, 'RequestSupplier'])->name("RequestSupplier");
Route::get('/AcceptableRequests', [App\Http\Controllers\HomeController::class, 'AcceptableRequests'])->name("AcceptableRequests");
Route::get('/refusedRequest', [App\Http\Controllers\HomeController::class, 'refusedRequest'])->name("refusedRequest"); 
Route::get('/AddOrder', [App\Http\Controllers\HomeController::class, 'AddOrder'])->name("AddOrder");
Route::post('/createorder', [App\Http\Controllers\HomeController::class, 'CreateOrder'])->name("CreateOrder");
Route::get('/deleteorder/{id}', [App\Http\Controllers\HomeController::class, 'DeleteOrder'])->name("DeleteOrder");
Route::get('/editorder/{id}', [App\Http\Controllers\HomeController::class, 'EditOrder'])->name("EditOrder");
Route::put('/updateorder/{id}', [App\Http\Controllers\HomeController::class, 'UpdateOrder'])->name("UpdateOrder");
Route::get('/addrequests', [App\Http\Controllers\SupplierController::class, 'AddRequests'])->name("AddRequests");
Route::post('/createrequests', [App\Http\Controllers\SupplierController::class, 'createRequests'])->name("CreateRequests");   
Route::get('/deleteRequests/{id}', [App\Http\Controllers\SupplierController::class, 'deleteRequests'])->name("deleteRequests");
Route::get('/editRequests/{id}', [App\Http\Controllers\SupplierController::class, 'editRequests'])->name("editRequests"); 
Route::put('/updateRequests/{id}', [App\Http\Controllers\SupplierController::class, 'updateRequests'])->name("updateRequests");
Route::put('/statusWaiting/{id}', [App\Http\Controllers\SupplierController::class, 'StatusWaiting'])->name("StatusWaiting");
Route::put('/StatusFailed/{id}', [App\Http\Controllers\SupplierController::class, 'StatusFailed'])->name("StatusFailed");
Route::get('/WorkerOrder', [App\Http\Controllers\HomeController::class, 'WorkerOrder'])->name("WorkerOrder");    
Route::post('/assignTask', [App\Http\Controllers\HomeController::class, 'assignTask'])->name("assignTask"); 
Route::get('/task', [App\Http\Controllers\HomeController::class, 'Task'])->name("Task");   
Route::get('/workertask', [App\Http\Controllers\HomeController::class, 'WorkerTask'])->name("Workertask");
Route::put('/taskDone/{id}', [App\Http\Controllers\HomeController::class, 'TaskDone'])->name("taskDone");

Route::get('/MessageAdmin', [App\Http\Controllers\HomeController::class, 'MessageAdmin'])->name('MessageAdmin');
Route::get('/MessageWorker', [App\Http\Controllers\HomeController::class, 'MessageWorker'])->name('MessageWorker');
Route::get('/MessageSupplier', [App\Http\Controllers\HomeController::class, 'MessageSupplier'])->name('MessageSupplier');
Route::get('/MessageManager', [App\Http\Controllers\HomeController::class, 'MessageManager'])->name('MessageManager'); 
Route::post('/createMessage', [App\Http\Controllers\HomeController::class, 'createMessage'])->name('createMessage');

Route::put('/submitProblem/{id}', [App\Http\Controllers\HomeController::class, 'submitProblem'])->name('submitProblem');

Route::get('/AcceptableSupplier', [App\Http\Controllers\SupplierController::class, 'AcceptableSupplier'])->name("AcceptableSupplier");
Route::get('/refusedSupplier', [App\Http\Controllers\SupplierController::class, 'refusedSupplier'])->name("refusedSupplier");

Route::get('/AcceptOffer/{id}', [App\Http\Controllers\HomeController::class, 'AcceptOffer'])->name("AcceptOffer");
Route::get('/Rop/{id}', [App\Http\Controllers\HomeController::class, 'Rop'])->name("Rop");

 Route::get('/search', [App\Http\Controllers\CustomerOrderController::class, 'search'])->name('search');
 Route::post('accept-offer/{id}', [App\Http\Controllers\SupplierController::class, 'acceptOffer'])->name('accept.offer');



});
