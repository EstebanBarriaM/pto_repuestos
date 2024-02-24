<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Auth\AuthCustomerController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\UserAdminController;
use App\Http\Controllers\Backend\UserCustomerController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductBrandController;
use App\Http\Controllers\Backend\CarModelController;
use App\Http\Controllers\Backend\CarBrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;

// General logout
Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

// Backend routes
Route::get('admin-login', [AuthAdminController::class, 'loginView'])->name('admin.loginView');
Route::post('admin-login', [AuthAdminController::class, 'login'])->name('admin.login');

Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Home route
        Route::get('/', [HomeController::class, 'index'])->name('backend.index');

        // User admin routes
        Route::prefix('users_admin')->group(function () {
            Route::get('/', [UserAdminController::class, 'index'])->name('users_admin.index');
            Route::get('/create', [UserAdminController::class, 'create'])->name('users_admin.create');
            Route::post('/', [UserAdminController::class, 'store'])->name('users_admin.store');
            Route::get('/{id}/edit', [UserAdminController::class, 'edit'])->name('users_admin.edit');
            Route::put('/{id}', [UserAdminController::class, 'update'])->name('users_admin.update');
            Route::delete('/{id}', [UserAdminController::class, 'destroy'])->name('users_admin.destroy');
        });

        // User customer routes
        Route::prefix('users_customer')->group(function () {
            Route::get('/', [UserCustomerController::class, 'index'])->name('users_customer.index');
            Route::get('/create', [UserCustomerController::class, 'create'])->name('users_customer.create');
            Route::post('/', [UserCustomerController::class, 'store'])->name('users_customer.store');
            Route::get('/{id}/edit', [UserCustomerController::class, 'edit'])->name('users_customer.edit');
            Route::put('/{id}', [UserCustomerController::class, 'update'])->name('users_customer.update');
            Route::delete('/{id}', [UserCustomerController::class, 'destroy'])->name('users_customer.destroy');
        });

        // Categories routes
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        });

        // Product routes
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/', [ProductController::class, 'store'])->name('products.store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
            Route::delete('/delete-image/{id}', [ProductController::class, 'destroyImage'])->name('products.destroy_image');
            Route::post('/add-images/{id}', [ProductController::class, 'addImages'])->name('products.add_images');
            Route::get('/compatible-models/{id}', [ProductController::class, 'compatibleModels'])->name('products.compatible_models');
            Route::post('/compatible-models/{id}', [ProductController::class, 'storeCompatibleModels'])->name('products.compatible_models.store');
        });

        // Products brands routes
        Route::prefix('product_brand')->group(function () {
            Route::get('/', [ProductBrandController::class, 'index'])->name('product_brand.index');
            Route::get('/create', [ProductBrandController::class, 'create'])->name('product_brand.create');
            Route::post('/', [ProductBrandController::class, 'store'])->name('product_brand.store');
            Route::get('/{id}/edit', [ProductBrandController::class, 'edit'])->name('product_brand.edit');
            Route::put('/{id}', [ProductBrandController::class, 'update'])->name('product_brand.update');
            Route::delete('/{id}', [ProductBrandController::class, 'destroy'])->name('product_brand.destroy');
        });

        // Car models routes
        Route::prefix('car_model')->group(function () {
            Route::get('/', [CarModelController::class, 'index'])->name('car_model.index');
            Route::get('/create', [CarModelController::class, 'create'])->name('car_model.create');
            Route::post('/', [CarModelController::class, 'store'])->name('car_model.store');
            Route::get('/{id}/edit', [CarModelController::class, 'edit'])->name('car_model.edit');
            Route::put('/{id}', [CarModelController::class, 'update'])->name('car_model.update');
            Route::delete('/{id}', [CarModelController::class, 'destroy'])->name('car_model.destroy');
        });

        // Car brands routes
        Route::prefix('car_brand')->group(function () {
            Route::get('/', [CarBrandController::class, 'index'])->name('car_brand.index');
            Route::get('/create', [CarBrandController::class, 'create'])->name('car_brand.create');
            Route::post('/', [CarBrandController::class, 'store'])->name('car_brand.store');
            Route::get('/{id}/edit', [CarBrandController::class, 'edit'])->name('car_brand.edit');
            Route::put('/{id}', [CarBrandController::class, 'update'])->name('car_brand.update');
            Route::delete('/{id}', [CarBrandController::class, 'destroy'])->name('car_brand.destroy');
        });

        // Orders routes
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('orders.index');
            Route::delete('/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        });
    });
});

// Frontend routes
Route::get('customer-login', [AuthCustomerController::class, 'loginView'])->name('customer.loginView');
Route::post('customer-login', [AuthCustomerController::class, 'login'])->name('customer.login');
Route::get('customer-register', [AuthCustomerController::class, 'registerView'])->name('customer.registerView');
Route::post('customer-register', [AuthCustomerController::class, 'register'])->name('customer.register');

// Home route
Route::get('/', [FrontendHomeController::class, 'index'])->name('frontend.index');
Route::get('/about-us', [FrontendHomeController::class, 'aboutUs'])->name('frontend.about_us');
Route::get('/contact', [FrontendHomeController::class, 'contact'])->name('frontend.contact');
Route::get('/category/{slug}', [FrontendProductController::class, 'productsByCategory'])->name('frontend.products.by_category');
Route::get('/product/{slug}', [FrontendProductController::class, 'show'])->name('frontend.products.show');
Route::get('/products', [FrontendProductController::class, 'index'])->name('frontend.products.index');

Route::middleware(['auth', 'checkRole:customer'])->group(function () {
    Route::get('/my-account', [FrontendHomeController::class, 'myAccountView'])->name('frontend.my_account.view');
    Route::post('/my-account', [FrontendHomeController::class, 'myAccountSave'])->name('frontend.my_account.save');
    Route::get('/my-orders', [FrontendHomeController::class, 'myOrders'])->name('frontend.my_orders');
    Route::post('/add-to-cart', [FrontendHomeController::class, 'addToCart'])->name('frontend.add_to_cart');
    Route::get('/cart', [FrontendHomeController::class, 'cart'])->name('frontend.cart');
    Route::post('/checkout', [FrontendHomeController::class, 'checkout'])->name('frontend.checkout');
    Route::get('/clear-cart', [FrontendHomeController::class, 'clearCart'])->name('frontend.clear_cart');
});
