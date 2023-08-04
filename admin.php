<?php

use App\Http\Controllers\Backend\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardsController;
use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\BlogsController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BusinessAccountController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\ContactsController;
use App\Http\Controllers\Backend\CacheController;
use App\Http\Controllers\Backend\CustomerMoneyOrderController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\LanguagesController;
use App\Http\Controllers\Backend\MoneyOrderController;
use App\Http\Controllers\Backend\ReceipentController;
use App\Http\Controllers\Backend\SettingsController;
use Faker\Provider\ar_EG\Payment;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Admin Panel Route List
|
*/
Route::get('/', [DashboardsController::class, 'admin']);
Route::get('/dashboard', [DashboardsController::class, 'dashboard'])->name('dashboard');

/**
 * Admin Management Routes
 */
Route::group(['prefix' => ''], function () {
    Route::resource('admins', AdminsController::class);
    Route::get('admins/trashed/view', [AdminsController::class, 'trashed'])->name('admins.trashed');
    Route::get('profile/edit', [AdminsController::class, 'editProfile'])->name('admins.profile.edit');
    Route::put('profile/update', [AdminsController::class, 'updateProfile'])->name('admins.profile.update');
    Route::delete('admins/trashed/destroy/{id}', [AdminsController::class, 'destroyTrash'])->name('admins.trashed.destroy');
    Route::put('admins/trashed/revert/{id}', [AdminsController::class, 'revertFromTrash'])->name('admins.trashed.revert');
});

/**
 * Employee Management Routes
 */
Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

Route::get('employee/trashed/view', [EmployeeController::class, 'trashed'])->name('employee.trashed');
Route::delete('employee/trashed/destroy/{id}', [EmployeeController::class, 'destroyTrash'])->name('employee.trashed.destroy');
Route::put('employee/trashed/revert/{id}', [EmployeeController::class, 'revertFromTrash'])->name('employee.trashed.revert');

/**
 * Business Management Routes
 */
Route::group(['prefix' => 'business-account', 'as' => 'business_account.'], function () {
    Route::get('', [BusinessAccountController::class, 'index'])->name('index');
    Route::get('create', [BusinessAccountController::class, 'create'])->name('create');
    Route::post('store', [BusinessAccountController::class, 'store'])->name('store');
    Route::get('{id}/edit', [BusinessAccountController::class, 'edit'])->name('edit');
    Route::put('{id}', [BusinessAccountController::class, 'update'])->name('update');
    Route::delete('{id}', [BusinessAccountController::class, 'destroy'])->name('destroy');

    Route::get('/trashed/view', [BusinessAccountController::class, 'trashed'])->name('trashed');
    Route::delete('/trashed/destroy/{id}', [BusinessAccountController::class, 'destroyTrash'])->name('trashed.destroy');
    Route::put('/trashed/revert/{id}', [BusinessAccountController::class, 'revertFromTrash'])->name('trashed.revert');
});

/**
 * Customer Management Routes
 */
Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('customer/create', [CustomerController::class, 'customerCreate'])->name('customer.create');
Route::post('customer/store', [CustomerController::class, 'customerStore'])->name('customer.store');
Route::get('customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

Route::get('customer/trashed/view', [CustomerController::class, 'trashed'])->name('customer.trashed');
Route::delete('customer/trashed/destroy/{id}', [CustomerController::class, 'destroyTrash'])->name('customer.trashed.destroy');
Route::put('customer/trashed/revert/{id}', [CustomerController::class, 'revertFromTrash'])->name('customer.trashed.revert');


/**
 * Role & Permission Management Routes
 */
Route::group(['prefix' => ''], function () {
    Route::resource('roles', RolesController::class);
});

/**
 * Receivers Management Routes
 */
Route::get('/receivers', [ReceipentController::class, 'receivers'])->name('receivers');
Route::get('/receiver-show/{id}', [ReceipentController::class, 'receiverShow'])->name('receiver.show');
Route::get('/new-recipient/create', [ReceipentController::class, 'newRecipientCreate'])->name('new.recipient.create');
Route::get('/new-recipient/create/{id}', [ReceipentController::class, 'newRecipientCreate'])->name('new.recipient.create.id');
Route::post('/new-recipient/store', [ReceipentController::class, 'newRecipientStore'])->name('new.recipient.store');

/**
 * Money Transaction Management Routes
 */
Route::group(['prefix' => 'transaction'], function () {
    // Money Transaction routes //
    Route::get('', [MoneyOrderController::class, 'index'])->name('transaction.index');
    Route::get('history/{id}', [MoneyOrderController::class, 'history'])->name('history');

    Route::get('/create', [MoneyOrderController::class, 'transactionCreate'])->name('transaction.create');
    Route::post('/store', [MoneyOrderController::class, 'transactionStore'])->name('transaction.store');

    Route::get('/recipient', [MoneyOrderController::class, 'recipient'])->name('recipient');
    Route::post('/recipient', [MoneyOrderController::class, 'recipientStore'])->name('recipient.store');
    Route::get('/recipient/{id}', [MoneyOrderController::class, 'recipientEdit'])->name('recipient.id');

    Route::get('/receiver/{id}/payment', [MoneyOrderController::class, 'receiverPayment'])->name('receiver.payment');
    Route::post('/receiver/{id}/payment', [MoneyOrderController::class, 'receiverPaymentStore'])->name('receiver.payment.store');

    Route::get('/sender/{id}/payment', [MoneyOrderController::class, 'senderPayment'])->name('sender.payment');
    Route::post('/sender/{id}/payment', [MoneyOrderController::class, 'senderPaymentStore'])->name('sender.payment.store');

    // Route::get('{id}/sender/edit', [MoneyOrderController::class, 'senderEdit'])->name('sender.edit');

    // customer routes //
    Route::get('/payment-history', [CustomerMoneyOrderController::class, 'customerIndex'])->name('customer.payment.index');
    Route::get('/review-payment/{order_id}', [CustomerMoneyOrderController::class, 'reviewPayment'])->name('review-payment');
    Route::post('/review-payment-store/{order_id}', [CustomerMoneyOrderController::class, 'reviewPaymentStore'])->name('review-payment-store');
    Route::get('customer/history/{id}', [CustomerMoneyOrderController::class, 'customerHistory'])->name('customer.history');
});

/**
 * Payments Management Routes
 */

// Route::group(['prefix' => 'transaction', 'as' => 'transaction.'], function () {
//     Route::get('', [PaymentController::class, 'index'])->name('index');
//     Route::get('create', [PaymentController::class, 'create'])->name('create');
//     Route::post('store', [PaymentController::class, 'store'])->name('store');
//     Route::get('show/{id}', [PaymentController::class, 'show'])->name('show');

//     Route::get('{id}', [PaymentController::class, 'edit'])->name('edit');
//     Route::post('{id}', [PaymentController::class, 'update'])->name('update');

//     Route::get('method/create/{id}', [PaymentController::class, 'paymentCreate'])->name('transaction.create');
//     Route::post('method/store/{id}', [PaymentController::class, 'paymentStore'])->name('transaction.store');

//     Route::get('recipient/create/{id}', [PaymentController::class, 'recipientCreate'])->name('recipient.create');
//     Route::post('recipient/store/{id}', [PaymentController::class, 'recipientStore'])->name('recipient.store');
// });


/**
 * Blog Management Routes
 */
Route::group(['prefix' => ''], function () {
    Route::resource('blogs', BlogsController::class);
    Route::get('blogs/trashed/view', [BlogsController::class, 'trashed'])->name('blogs.trashed');
    Route::delete('blogs/trashed/destroy/{id}', [BlogsController::class, 'destroyTrash'])->name('blogs.trashed.destroy');
    Route::put('blogs/trashed/revert/{id}', [BlogsController::class, 'revertFromTrash'])->name('blogs.trashed.revert');
});

/**
 * Blog Category Management Routes
 */
Route::group(['prefix' => 'blog-category', 'as' => 'blog_category.'], function () {
    Route::get('', [BlogCategoryController::class, 'index'])->name('index');
    Route::get('create', [BlogCategoryController::class, 'create'])->name('create');
    Route::post('store', [BlogCategoryController::class, 'store'])->name('store');
    Route::get('{id}/edit', [BlogCategoryController::class, 'edit'])->name('edit');
    Route::put('{id}', [BlogCategoryController::class, 'update'])->name('update');
    Route::delete('{id}', [BlogCategoryController::class, 'destroy'])->name('destroy');

    Route::get('/trashed/view', [BlogCategoryController::class, 'trashed'])->name('trashed');
    Route::delete('/trashed/destroy/{id}', [BlogCategoryController::class, 'destroyTrash'])->name('trashed.destroy');
    Route::put('/trashed/revert/{id}', [BlogCategoryController::class, 'revertFromTrash'])->name('trashed.revert');
});

/**
 * Contact Routes
 */
Route::group(['prefix' => ''], function () {
    Route::resource('contacts', ContactsController::class);
});

/**
 * Settings Management Routes
 */
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/update', [SettingsController::class, 'update'])->name('settings.update');
    Route::resource('languages', LanguagesController::class);
});

Route::get('reset-cache', [CacheController::class, 'reset_cache']);
