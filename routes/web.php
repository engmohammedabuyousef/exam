<?php

use App\Http\Controllers\UserController;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/file-import', [UserController::class, 'importView'])->name('import-view');
Route::post('/import', [UserController::class, 'import'])->name('import');


Route::get('top-orders', function () {
    $orders = Order::where('total_cost', '>', 500)->get();
    return view('one', compact('orders'));
});

Route::get('users', function () {
    $statusTypes = ['new', 'confirm', 'shipped', 'processed', 'delivered', 'return_in_progress', 'returned', 'canceled'];

    $users = User::select('users.id', 'users.name')
        ->withCount('orders')
        ->withCount(
            array_map(function ($status) {
                return "orders as {$status}_orders_count";
            }, $statusTypes)
        )
        ->withSum('orders', 'total_cost')
        ->get();
    return view('two', compact('users', 'statusTypes'));
});

Route::get('top-sales', function () {
    $products = Product::select('products.id', 'products.title')
        ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
        ->groupBy('products.id', 'products.title')
        ->orderByRaw('COUNT(order_items.order_id) DESC')
        ->limit(3)
        ->get();

    return view('three', compact('products'));
});

Route::get('create-order', function () {
    $order = Order::create(); // with all order_items

    $order_items = $order->ordersItems();
    // after create an order: update on 'inventories' table => decrease the qun of this product

    foreach ($order_items as $item) {
        DB::table('inventories')
            ->where('product_id', $item->product_id)
            ->decrement('qty',  $item->qty);
    }
});
