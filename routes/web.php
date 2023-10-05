<?php

use App\Http\Controllers\BranchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\IncomeExpenseController;
use App\Http\Controllers\IncomeExpenseHeadController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LensController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockTransferController;
use App\Http\Controllers\SupplierController;
use App\Models\Invoice;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::post('/', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['web', 'auth']], function(){  
    Route::post('store_branch_session', [UserController::class, 'store_branch_session'])->name('store_branch_session');
    Route::get('/dash', [UserController::class, 'dash'])->name('dash');
});
Route::group(['middleware' => ['web', 'auth', 'branch']], function(){   

    Route::get('/helper/createddlcat', [HelperController::class, 'createddlcat'])->name('createddlcat');
    Route::get('/helper/createddl/{category}', [HelperController::class, 'createddl'])->name('createddl');
    Route::get('/helper/createddlSubCat/{category}', [HelperController::class, 'createddlSubCat'])->name('createddlSubCat');
    Route::get('/helper/createddlProduct/{subcategory}', [HelperController::class, 'createddlProduct'])->name('createddlPrdct');
    Route::get('/helper/getProductPrice', [HelperController::class, 'getProductPrice'])->name('getProductPrice');
    Route::get('/helper/getProduct', [HelperController::class, 'getProduct'])->name('getProduct');

    Route::get('/pdf/order-bill/{id}', [PDFController::class, 'orderBill'])->name('pdf.orderbill');
    Route::get('/pdf/payment-receipt/{id}', [PDFController::class, 'paymentReceipt'])->name('pdf.paymentreceipt');
    Route::get('/pdf/invoice/{id}', [PDFController::class, 'invoice'])->name('pdf.invoice');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.save');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/role', [RoleController::class, 'index'])->name('role');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/create', [RoleController::class, 'store'])->name('role.save');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/edit/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.save');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('subcategory');
    Route::get('/subcategory/create', [SubcategoryController::class, 'create'])->name('subcategory.create');
    Route::post('/subcategory/create', [SubcategoryController::class, 'store'])->name('subcategory.save');
    Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('/subcategory/edit/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');
    Route::delete('/subcategory/delete/{id}', [SubcategoryController::class, 'destroy'])->name('subcategory.delete');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/create', [ProductController::class, 'store'])->name('product.save');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/edit/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    Route::get('/branch', [BranchController::class, 'index'])->name('branch');
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/create', [BranchController::class, 'store'])->name('branch.save');
    Route::get('/branch/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/branch/edit/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::delete('/branch/delete/{id}', [BranchController::class, 'destroy'])->name('branch.delete');

    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/fetch', [OrderController::class, 'fetch'])->name('order.fetch');
    Route::get('/order/create/{id}', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/create/{id}', [OrderController::class, 'store'])->name('order.save');
    Route::get('/order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('/order/edit/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/delete/{id}', [OrderController::class, 'destroy'])->name('order.delete');

    Route::get('/order/payment', [OrderPaymentController::class, 'index'])->name('order.payment');
    Route::post('/order/payment', [OrderPaymentController::class, 'fetch'])->name('order.payment.fetch');
    Route::get('/order/payment/proceed', [OrderPaymentController::class, 'fetch'])->name('order.payment.proceed');
    Route::get('/order/payment/create/{id}', [OrderPaymentController::class, 'create'])->name('order.payment.create');
    Route::post('/order/payment/create', [OrderPaymentController::class, 'store'])->name('order.payment.save');
    Route::delete('/order/payment/delete/{id}', [OrderController::class, 'destroy'])->name('order.payment.delete');

    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
    Route::post('/invoice', [InvoiceController::class, 'fetch'])->name('invoice.fetch');
    Route::get('/invoice/proceed', [InvoiceController::class, 'fetch'])->name('invoice.proceed');
    Route::get('/invoice/create/{id}', [InvoiceController::class, 'create'])->name('invoice.create');
    /*Route::post('/invoice/create', [InvoiceController::class, 'store'])->name('invoice.save');*/
    Route::put('/invoice/delete/{id}', [InvoiceController::class, 'destroy'])->name('invoice.delete');

    Route::get('/iehead', [IncomeExpenseHeadController::class, 'index'])->name('iehead');
    Route::get('/iehead/create', [IncomeExpenseHeadController::class, 'create'])->name('iehead.create');
    Route::post('/iehead/create', [IncomeExpenseHeadController::class, 'store'])->name('iehead.save');
    Route::get('/iehead/edit/{id}', [IncomeExpenseHeadController::class, 'edit'])->name('iehead.edit');
    Route::put('/iehead/edit/{id}', [IncomeExpenseHeadController::class, 'update'])->name('iehead.update');
    Route::delete('/iehead/delete/{id}', [IncomeExpenseHeadController::class, 'destroy'])->name('iehead.delete');

    Route::get('/ie', [IncomeExpenseController::class, 'index'])->name('ie');
    Route::get('/ie/create', [IncomeExpenseController::class, 'create'])->name('ie.create');
    Route::post('/ie/create', [IncomeExpenseController::class, 'store'])->name('ie.save');
    Route::get('/ie/edit/{id}', [IncomeExpenseController::class, 'edit'])->name('ie.edit');
    Route::put('/ie/edit/{id}', [IncomeExpenseController::class, 'update'])->name('ie.update');
    Route::delete('/ie/delete/{id}', [IncomeExpenseController::class, 'destroy'])->name('ie.delete');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/supplier/create', [SupplierController::class, 'store'])->name('supplier.save');
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/edit/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier/delete/{id}', [SupplierController::class, 'destroy'])->name('supplier.delete');

    Route::get('/stockin', [StockTransferController::class, 'index'])->name('stockin');
    Route::get('/stockin/create', [StockTransferController::class, 'create'])->name('stockin.create');
    Route::post('/stockin/create', [StockTransferController::class, 'store'])->name('stockin.save');
    Route::get('/stockin/edit/{id}', [StockTransferController::class, 'edit'])->name('stockin.edit');
    Route::put('/stockin/edit/{id}', [StockTransferController::class, 'update'])->name('stockin.update');
    Route::delete('/stockin/delete/{id}', [StockTransferController::class, 'destroy'])->name('stockin.delete');

    Route::get('/stockout', [StockTransferController::class, 'indexd'])->name('stockout');
    Route::get('/stockout/create', [StockTransferController::class, 'created'])->name('stockout.create');
    Route::post('/stockout/create', [StockTransferController::class, 'stored'])->name('stockout.save');
    Route::get('/stockout/edit/{id}', [StockTransferController::class, 'editd'])->name('stockout.edit');
    Route::put('/stockout/edit/{id}', [StockTransferController::class, 'updated'])->name('stockout.update');
    Route::delete('/stockout/delete/{id}', [StockTransferController::class, 'destroyd'])->name('stockout.delete');

    Route::get('/stockinhand', [HelperController::class, 'stockinhand'])->name('stockinhand');
    Route::post('/stockinhand', [HelperController::class, 'fetchstockinhand'])->name('stockinhand.fetch');
    
    Route::get('/stock/tracking/list', [LensController::class, 'index'])->name('stock.tracking.list');
    Route::get('/stock/tracking/product', [LensController::class, 'create'])->name('stock.tracking.create');
    Route::post('/stock/tracking/product', [LensController::class, 'store'])->name('stock.tracking.save');
    Route::get('/stock/tracking/product/edit/{id}', [LensController::class, 'edit'])->name('stock.tracking.edit');
    Route::put('/stock/tracking/product/edit/{id}', [LensController::class, 'update'])->name('stock.tracking.update');
    Route::delete('/stock/tracking/product/delete/{id}', [LensController::class, 'destroy'])->name('stock.tracking.delete');

    Route::get('/stock/tracking/material', [LensController::class, 'creatematerial'])->name('stock.tracking.create.material');
    Route::post('/stock/tracking/material', [LensController::class, 'storematerial'])->name('stock.tracking.save.material');

    Route::get('/stock/tracking/coating', [LensController::class, 'createcoating'])->name('stock.tracking.create.coating');
    Route::post('/stock/tracking/coating', [LensController::class, 'storecoating'])->name('stock.tracking.save.coating');

    Route::get('/stock/tracking/type', [LensController::class, 'createtype'])->name('stock.tracking.create.type');
    Route::post('/stock/tracking/type', [LensController::class, 'storetype'])->name('stock.tracking.save.type');

});
