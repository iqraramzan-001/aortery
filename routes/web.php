<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WareHouseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;



Route::get('/', [FrontController::class, 'home'])->name('home');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::controller(FrontController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('support', 'support')->name('support');
    Route::post('contact','contact')->name('contact');

});


Route::controller(AuthController::class)->group(function () {
    Route::get('verify-otp', 'showOtpForm')->name('password.otp.send');
    Route::post('verify-otp', 'verifyOtp')->name('password.otp.verify');
    Route::get('login', 'login')->name('login');
    Route::get('register', 'register')->name('register');
    Route::post('signin', 'signin')->name('signin');
    Route::post('signup', 'signup')->name('signup');
});


Route::prefix('product')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('index', 'index')->name('product.index');
        Route::get('show/{id?}','show')->name('product.details');
    });
});




Route::prefix('cart')->group(function () {
    Route::controller(CartController::class)->group(function () {
        Route::get('index', 'index')->name('cart.index');
        Route::get('create','create')->name('cart.create');
        Route::post('store', 'store')->name('cart.store');
        Route::get('edit/{id}','edit')->name('cart.edit');
        Route::post('update','update')->name('cart.update');
        Route::get('show/{id?}','show')->name('cart.details');
        Route::delete('/delete/{id}', 'destroy')->name('cart.delete');

    });
});

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/filter', [ProductController::class, 'filter'])->name('product.filter');

Route::group(['middleware' => 'auth'], function (){

    Route::post('/upload-image', [ProductController::class,'uploads'])->name('image.upload');
    Route::get('/categories/{parent_id}', [ProductController::class, 'getSubCategories']);

    Route::prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('admin.dashboard');
            Route::get('approval','approval')->name('admin.approval');
            Route::post('update-status/{userId}/{status}', 'updateStatus')->name('update.status');
            Route::delete('/delete-user/{id}', 'destroy')->name('user.delete');
            Route::get('/view-profile/{id}', 'viewProfile')->name('view.profile');



        });
    });

    Route::prefix('product')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('create','create')->name('product.create');
            Route::post('store', 'store')->name('product.store');
            Route::get('edit/{id}','edit')->name('product.edit');
            Route::post('update/{id}','update')->name('product.update');

            Route::get('download','downloadCSV')->name('product.download');
            Route::post('upload','uploadCSV')->name('product.upload');
            Route::delete('/delete/{id}', 'delete')->name('product.delete');


        });
    });



    Route::prefix('order')->group(function () {
        Route::controller(OrderController::class)->group(function () {
            Route::get('index', 'index')->name('order.index');
            Route::get('create','create')->name('order.create');
            Route::post('store', 'store')->name('order.store');
            Route::get('edit/{id}','edit')->name('order.edit');
            Route::post('update','update')->name('order.update');
            Route::get('show/{id?}','show')->name('order.details');
            Route::post('status/{id}', 'status')->name('order.status');
            Route::post('item/status/{id}', 'updateStatus')->name('order.item.status');

        });
    });

    Route::prefix('supplier')->group(function () {
        Route::controller(SupplierController::class)->group(function () {
            Route::get('profile', 'create')->name('supplier.profile');
            Route::post('profile', 'profile')->name('save.supplier.profile');
            Route::get('products','products')->name('supplier.product');


        });
    });

    Route::prefix('buyer')->group(function () {
        Route::controller(BuyerController::class)->group(function () {
            Route::get('profile', 'create')->name('buyer.profile');
            Route::post('profile', 'profile')->name('save.buyer.profile');


        });
    });
    Route::prefix('warehouse')->group(function () {
        Route::controller(WareHouseController::class)->group(function () {
            Route::post('save', 'store')->name('save.warehouse');
            Route::delete('/delete/{id}', 'destroy')->name('delete.warehouse');
        });
    });
});







Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('forgot-password', 'showForgotPasswordForm')->name('forgot.password');
    Route::post('send-reset-link', 'sendResetLink')->name('forgot.password.send');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('reset-password/{token}','resetPassword')->name('password.reset');
    Route::post('update-password', 'updatePassword')->name('update.password');
});

