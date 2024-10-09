<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoyController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Frontpanel\AccountController;
use App\Http\Controllers\Frontpanel\HomepageController;
use App\Http\Controllers\Frontpanel\ProductController;
use App\Http\Controllers\ReviwController;
use App\Mail\OrderApprovalMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/shop', [HomepageController::class, 'ShopPage'])->name('shop');
Route::get('/about-us', [HomepageController::class, 'AboutUs'])->name('aboutus');
Route::get('/contact-us', [HomepageController::class, 'ContactUs'])->name('contactus');
Route::post('/contact/store', [HomepageController::class, 'ContactStore'])->name('contact.store');

// User Login----------------
Route::get('/user/account', [AdminController::class, 'myAcocunt'])->name('user.account');
Route::get('/user/edit/{id}', [AdminController::class, 'userEdit'])->name('user.edit');
Route::put('/user/update/{id}', [AdminController::class, 'userUpdate'])->name('user.update');
Route::get('/user/my-oders', [AdminController::class, 'myOders'])->name('user.myoders');
Route::get('/user/order-details/{id}', [AdminController::class, 'orderDetails'])->name('order.details');

// Admin Login-----------------
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.login');
Route::post('/check/login', [AdminController::class, 'login'])->name('check.login');

// Cart Routes-----------------
Route::get('/add-to-cart/{id}', [CartController::class, 'cart'])->name('add.to.cart');
Route::get('/cart/details', [CartController::class, 'cartDetails'])->name('cart.details');
Route::put('/cart/update/{id}', [CartController::class, 'cartUpdate'])->name('cart.update');
Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');


// Frontpanel Products Routes----------
Route::get('/product-details/{id}', [ProductController::class, 'productDetails'])->name('productdetails');
Route::get('/category-product/{id}', [ProductController::class, 'CatProduct'])->name('category.product');
Route::get('/subcategory-product/{id}', [ProductController::class, 'subCatProduct'])->name('subcategory.product');
Route::get('/brand-product/{id}', [ProductController::class, 'brandProduct'])->name('brand.product');
Route::get('/product-cart', [ProductController::class, 'productCart'])->name('cart');

// Review Routes--------------
// Route::get('review', [ReviwController::class,'index'])->name('review');
Route::post('review/store', [ReviwController::class, 'store'])->name('review.store');

// Route::get('/user-account', [AccountController::class, 'index'])->name('useraccount');

// SSLCOMMERZ Start
Route::post('/pay', [CheckoutController::class, 'store']);
Route::any('success', [CheckoutController::class, 'success']);
Route::any('fail', [CheckoutController::class, 'fail']);
Route::any('cancel', [CheckoutController::class, 'cancel']);
//SSLCOMMERZ END

// Admin Panel----------------------------
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');

    Route::get('contact/info', [DashboardController::class, 'contact'])->name('contact.info');
    Route::get('contact/show/{id}', [DashboardController::class, 'contactShow'])->name('contact.show');
    Route::get('contact/change/status/{id}', [DashboardController::class, 'changeStatus'])->name('contact.change.status');

    Route::get('user/info', [DashboardController::class, 'userInfo'])->name('user.info');
    // Slider Routes----------------------
    Route::get('slider', [SliderController::class, 'index'])->name('slider');
    Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('slider/switch{id}', [SliderController::class, 'switch'])->name('slider.switch');
    Route::post('slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::put('slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('slider/destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

    // Category Routes-------------------
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Subcategory Routes----------------
    Route::get('subcategory', [SubCategoyController::class, 'index'])->name('subcategory');
    Route::get('subcategory/create', [SubCategoyController::class, 'create'])->name('subcategory.create');
    Route::post('subcategory/store', [SubCategoyController::class, 'store'])->name('subcategory.store');
    Route::get('subcategory/edit/{id}', [SubCategoyController::class, 'edit'])->name('subcategory.edit');
    Route::put('subcategory/update/{id}', [SubCategoyController::class, 'update'])->name('subcategory.update');
    Route::delete('subcategory/destroy/{id}', [SubCategoyController::class, 'destroy'])->name('subcategory.destroy');

    // Brand Routes----------------------
    Route::get('brand', [BrandController::class, 'index'])->name('brand');
    Route::get('brand/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('brand/destroy/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');

    // Product Routes--------------------
    Route::get('product', [AdminProductController::class, 'index'])->name('product');
    Route::get('product/create', [AdminProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [AdminProductController::class, 'store'])->name('product.store');
    Route::get('product/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::put('product/update/{id}', [AdminProductController::class, 'update'])->name('product.update');
    Route::delete('product/destroy/{id}', [AdminProductController::class, 'destroy'])->name('product.destroy');

    // Order Routes----------------------
    Route::get('order/pending', [OrderController::class, 'pending'])->name('admin.order.pending');
    Route::get('order/details/{id}', [OrderController::class, 'show'])->name('admin.order.details');
    Route::get('order/approve/{id}', [OrderController::class, 'approval'])->name('admin.order.approve');

    // System Routes---------------------
    Route::get('system/aboutus', [SystemController::class, 'about'])->name('system.aboutus');
    Route::put('system/aboutus/update/{id}', [SystemController::class, 'update'])->name('system.aboutus.update');

    // Site Settings Routes--------------
    Route::get('system/site/settings', [SystemController::class, 'siteSettings'])->name('system.site.settings');
    Route::put('site/settings/update/{id}', [SystemController::class, 'siteUpdate'])->name('site.settings.update');
});
