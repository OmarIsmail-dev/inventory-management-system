<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\Api\MyApiController;
use App\Http\Controllers\API\Auth\ApiLoginController;
use App\Http\Controllers\Api\MessagesController;
use App\Models\Product;


 Route::get('/test',function(){

     return "Hello api";

 });

 Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [UsersController::class, 'categories']);

#routes for the applicationstart here
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    //login-page
    Route::post('/app-login', [ApiLoginController::class, 'login']);
    //dashboard-page
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/order-stats', [CustomerOrderController::class, 'orderStats']);
    Route::get('/refused-order', [CustomerOrderController::class, 'refusedOrders']);
    //employees-page
    
    Route::get('/employees', [UsersController::class, 'employees']);
    Route::post('/employees', [UsersController::class, 'store']);
    Route::put('/employees/{id}', [UsersController::class, 'updateEmployee']);
    Route::delete('/employees/{id}', [UsersController::class, 'destroy']);
    Route::post('employees/message', [UsersController::class, 'sendMessageToManager'])->middleware('auth:sanctum');

    //suppliers-page
    Route::get('/suppliers', [usersController::class, 'suppliers']);
    Route::post('/suppliers', [UsersController::class, 'storeSupplier']);
    Route::put('/suppliers/{id}', [UsersController::class, 'updateSupplier']);
    Route::delete('/suppliers/{id}', [UsersController::class, 'destroySupplier']);
    Route::post('/suppliers/message', [UsersController::class, 'sendMessageToSupplier']);
    //message-page
    Route::get('messages', [MessagesController::class, 'index'])->middleware('auth:sanctum');

 Route::get('/product', [App\Http\Controllers\Api\ProductController::class, 'index'])->name("product");
 Route::get('/product/{id}', [App\Http\Controllers\Api\ProductController::class, 'show'])->name('product');
 Route::put('/updateStock/{id}', [App\Http\Controllers\Api\ProductController::class, 'updateStock'])->name('updateStock');


 Route::get('/Category', [App\Http\Controllers\Api\CategoryController::class, 'index'])->name("Category");
 Route::get('/Category/{id}', [App\Http\Controllers\Api\CategoryController::class, 'show'])->name('Category');


Route::post('/update-inventory', function (Request $request) {
$product = Product::find($request->product_id);

if ($product) {

if ($request->action === 'decrease') {
    $product->decrement('in_stock', $request->quantity);
    return response()->json([
        'message' => 'Stock updated in inventory',
        'in_stock' => $product->in_stock
    ]);

}

elseif ($request->action === 'increase') {
    $product->increment('in_stock', $request->quantity);
    return response()->json([
        'message' => 'Stock updated in inventory',
        'in_stock' => $product->in_stock
    ]);
}

else {
    return response()->json(['message' => 'Invalid action'], 400);
}



}

return response()->json(['message' => 'Product not found'], 404);

});
