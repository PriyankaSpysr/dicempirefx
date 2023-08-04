<?php

use App\Http\Controllers\API\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PagesController;
use App\Http\Controllers\API\SettingsController;
use App\Http\Controllers\Backend\MoneyOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('sender-search',[MoneyOrderController::class,'senderSearch']);
Route::get('receiver-search',[MoneyOrderController::class,'receiverSearch']);

//  contact-us api
Route::post('contact-us',[ContactUsController::class,'Contact']);
Route::get('contacts',[ContactUsController::class,'ContactList']);

//  Booking Request api
Route::get('booking-request',[ContactUsController::class,'bookingRequest']);
// Route::post('booking-request-create',[ContactUsController::class,'bookingRequestCreate']);
Route::post('booking-request-update',[ContactUsController::class,'bookingRequestUpdate']);
Route::get('booking-request-delete',[ContactUsController::class,'bookingRequestDelete']);

//  Blog api
Route::post('blogs/create',[BlogController::class,'blogsAddEdit']);
Route::post('blogs/update',[BlogController::class,'blogsAddEdit']);
Route::get('blogs',[BlogController::class,'blogsList']);
Route::get('blog/delete', [BlogController::class, 'blogsDelete']);

//  Blog Category api
Route::post('blog-category/create',[BlogController::class,'blogCategoryAddEdit']);
Route::post('blog-category/update',[BlogController::class,'blogCategoryAddEdit']);
Route::get('blog-category',[BlogController::class,'blogCategoryList']);
Route::get('blog-category/delete', [BlogController::class, 'blogCategoryDelete']);

//  Service api
Route::post('service/create',[ServiceController::class,'serviceAddEdit']);
Route::post('service/update',[ServiceController::class,'serviceAddEdit']);
Route::get('service',[ServiceController::class,'serviceList']);
Route::get('service/delete', [ServiceController::class, 'serviceDelete']);

//  Pages api
Route::post('pages/create',[PagesController::class,'pagesAddEdit']);
Route::post('pages/update',[PagesController::class,'pagesAddEdit']);
Route::get('pages',[PagesController::class,'pagesList']);
Route::get('pages/delete', [PagesController::class, 'pagesDelete']);

//  Categories api
Route::post('categories/create',[CategoryController::class,'categoriesAddEdit']);
Route::post('categories/update',[CategoryController::class,'categoriesAddEdit']);
Route::get('categories',[CategoryController::class,'categoriesList']);
Route::get('categories/delete', [CategoryController::class, 'categoriesDelete']);

//  Admin api
Route::post('admins/create',[AdminController::class,'adminAddEdit']);
Route::post('admins/update',[AdminController::class,'adminAddEdit']);
Route::get('admins',[AdminController::class,'adminList']);
Route::get('admins/delete', [AdminController::class, 'adminDelete']);

//  Roles api
Route::post('roles/create',[AdminController::class,'rolesAddEdit']);
Route::post('roles/update',[AdminController::class,'rolesAddEdit']);
Route::get('roles',[AdminController::class,'rolesList']);
Route::get('roles/delete', [AdminController::class, 'rolesDelete']);

//  Languages api
Route::post('languages/create',[SettingsController::class,'languagesAddEdit']);
Route::post('languages/update',[SettingsController::class,'languagesAddEdit']);
Route::get('languages',[SettingsController::class,'languagesList']);

//  Settings api
Route::post('settings/update',[SettingsController::class,'settingsUpdate']);

