<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/', [UserController::class, 'home'])->name('index');
Route::get('/allproducts', [UserController::class, 'allProducts'])->name('viewallproducts');
Route::get('/productdetails/{id}', [UserController::class, 'productDetails'])->name('product_details');
Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/addtocart/{id}', [UserController::class, 'addToCard'])->middleware(['auth', 'verified'])->name('add_to_cart');
Route::get('/cartproducts', [UserController::class, 'cartProducts'])->middleware(['auth', 'verified'])->name('cartproducts');
Route::get('/removecartproducts/{id}', [UserController::class, 'removeCartProducts'])->middleware(['auth', 'verified'])->name('removecartproducts');
Route::post('/confirm_order', [UserController::class, 'confirmOrder'])->middleware(['auth', 'verified'])->name('confirm_order');

Route::get('/myorders', [UserController::class, 'myOrders'])->middleware(['auth', 'verified'])->name('myorders');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/add_category', [AdminController::class, 'postaddcategory'])->name('admin.postaddcategory');
  
    Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    Route::Delete('/delete_category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deletecategory');
    Route::get('/update_category/{id}',[AdminController::class,'updateCategory'])->name('admin.updatecategory');
    Route::post('/update_category/{id}',[AdminController::class,'postUpdateCategory'])->name('admin.postupdatecategory');
    Route::get('/add_product',[AdminController::class,'addProduct'])->name('admin.addproduct');
    Route::post('/add_product',[AdminController::class,'postAddProduct'])->name('admin.postaddproduct');
    Route::get('/view_product', [AdminController::class, 'viewProduct'])->name('admin.viewproduct');
    Route::Delete('/delete_product/{id}', [AdminController::class,'deleteProduct'])->name('admin.deleteproduct');
    Route::get('/update_product/{id}',[AdminController::class,'updateProduct'])->name('admin.updateproduct');
    Route::post('/update_product/{id}',[AdminController::class,'postUpdateProduct'])->name('admin.postupdateproduct');
    Route::post('/search_product',[AdminController::class,'searchProduct'])->name('admin.searchproduct');
    Route::get('/vieworder', [AdminController::class, 'viewOrder'])->name('admin.vieworder');
    Route::post('/change_status/{id}',[AdminController::class,'changeStatus'])->name('admin.change_status');

    Route::get('/downloadpdf/{id}',[AdminController::class,'downloadPdf'])->name('admin.downloadpdf');

    
  

});

require __DIR__.'/auth.php';
