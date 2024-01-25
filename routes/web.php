<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;


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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');



// ================== User Routes =================  //

Route::get('/', [HomeController::class, 'index'])->name('user.index');
Route::post('/Cart/{id}', [HomeController::class, 'cart'])->name('user.cart')->middleware('user');
Route::get('/ShowCart', [HomeController::class, 'show_cart'])->name('user.show_cart')->middleware('user');
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->name('user.remove_cart')->middleware('user');
Route::get('/Checkout', [HomeController::class, 'checkout'])->name('user.checkout')->middleware('user');
Route::get('/Contact', [HomeController::class, 'contact'])->name('user.contact');
Route::post('/Contact', [HomeController::class, 'add_contact'])->name('user.add_contact');
Route::get('/Detail/{id}', [HomeController::class, 'detail'])->name('user.detail');
Route::get('/Shop', [HomeController::class, 'shop'])->name('user.shop');
Route::get('/Order', [HomeController::class, 'place_order'])->name('user.place_order')->middleware('user');
Route::get('/AllOrder', [HomeController::class, 'show_order'])->name('user.show_order')->middleware('user');
Route::get('/cancel-order/{id}', [HomeController::class, 'cancel_order'])->name('user.cancel_order')->middleware('user');
Route::get('/Searchs', [HomeController::class, 'user_search'])->name('user.search');
Route::get('stripe/{total}', [HomeController::class, 'stripe'])->name('user.stripe')->middleware('user');
Route::post('stripe/{total}', [HomeController::class, 'stripePost'])->name('stripe.post')->middleware('user');


// ================== User Routes =================  //


// ================== Admin Routes =================  //
Route::middleware(['admin'])->group(function () {
    //Product Routes start here
    Route::get('/Product', [AdminController::class, 'view_product'])->name('view.product');
    Route::post('/Product', [AdminController::class, 'add_product'])->name('add.product');
    Route::get('/AllProduct', [AdminController::class, 'show_product'])->name('show.product');
    Route::get('/DeleteProduct/{id}', [AdminController::class, 'delete_product'])->name('delete.product');
    Route::get('/ForceProduct/{id}', [AdminController::class, 'force_product'])->name('force.delete.product');
    Route::get('/RestoreProduct/{id}', [AdminController::class, 'restore_product'])->name('restore.product');

    Route::get('/TrashProduct', [AdminController::class, 'trash_product'])->name('trash.product');

    Route::get('/UpdateProduct/{id}', [AdminController::class, 'update_product'])->name('update.product');
    Route::post('/ViewUpdateProduct/{id}', [AdminController::class, 'view_update_product'])->name('view.update.product');
    //Product Routes end here

    //Category Routes start here
    Route::get('/Category', [AdminController::class, 'view_category'])->name('view.category');
    Route::post('/Category', [AdminController::class, 'add_category'])->name('add.category');
    Route::get('/AllCategory', [AdminController::class, 'show_category'])->name('show.category');
    Route::get('/DeleteCategory/{id}', [AdminController::class, 'delete_category'])->name('delete.category');
    //Category Routes end here

    // Orders Route start here
    Route::get('/Orders', [AdminController::class, 'orders'])->name('view.orders');
    Route::get('/Order/{id}', [AdminController::class, 'deliverd_order'])->name('deliverd.order');
    Route::get('/Print/{id}', [AdminController::class, 'print_pdf'])->name('view.pdf');
    Route::get('/Notify/{id}', [AdminController::class, 'notify'])->name('view.notify');
    Route::post('/Notify/{id}', [AdminController::class, 'sent_notify'])->name('view.sent_notify');
    Route::get('/Search', [AdminController::class, 'search'])->name('view.search');
    // Orders Route end here

    // User Message Route start here
    Route::get('/message', [AdminController::class, 'message'])->name('view.message');
    // User Message Route end here

});


// ================== Admin Routes =================  //