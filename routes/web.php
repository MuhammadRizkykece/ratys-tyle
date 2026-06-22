<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\MyOrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Front\WishlistController;


// FRONT WEBSITE

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/shop', [ShopController::class, 'index'])
    ->name('shop');

Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('product.detail');

Route::get('/category', [CategoryController::class, 'index'])
    ->name('category');

Route::get('/category/{slug}', [CategoryController::class, 'show'])
    ->name('category.show');

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');

Route::post('/coupon/apply', [CartController::class, 'applyCoupon'])
    ->name('coupon.apply');

Route::patch('/cart/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::patch('/cart/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::middleware('auth')->group(function () {

    Route::get('/my-orders', [MyOrderController::class, 'index'])
        ->name('my-orders');
});

Route::get('/my-orders/{id}', [MyOrderController::class, 'show'])
    ->name('my-orders.show');

Route::get('/my-orders', [MyOrderController::class, 'index'])
    ->name('my-orders');

Route::get('/my-orders/{id}', [MyOrderController::class, 'show'])
    ->name('my-orders.show');

Route::post(
    '/my-orders/{id}/upload-proof',
    [MyOrderController::class, 'uploadProof']
)->name('my-orders.upload-proof');

Route::get('/invoice/{order}', function (Order $order) {

    $order->load(
        'items.product',
        'user'
    );

    $pdf = Pdf::loadView('pdf.invoice', [
        'order' => $order,
    ]);

    return $pdf->download(
        'Invoice_Order_' . $order->id . '.pdf'
    );
});

Route::get('/export-orders', function () {
    return Excel::download(
        new OrdersExport,
        'laporan-penjualan.xlsx'
    );
});

Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::post('/product/{product}/review', [
    ProductController::class,
    'review'
])->middleware('auth')
    ->name('product.review');

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('category.index');

Route::get('/invoice/{order}', function (Order $order) {

    $order->load('items.product', 'user');

    $pdf = Pdf::loadView('pdf.invoice', [
        'order' => $order,
    ]);

    return $pdf->download(
        'Invoice_Order_' . $order->id . '.pdf'
    );
})->name('invoice.download');

// Route::post(
//     '/midtrans/callback',
//     [CheckoutController::class, 'callback']
// );

// USER

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/wishlist', [
        WishlistController::class,
        'index'
    ])->name('wishlist');

    Route::post('/wishlist/add/{product}', [
        WishlistController::class,
        'add'
    ])->name('wishlist.add');

    Route::delete('/wishlist/{id}', [
        WishlistController::class,
        'remove'
    ])->name('wishlist.remove');
});


require __DIR__ . '/auth.php';
