<?php


use App\Http\Controllers\backend\adminPageController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\web\homePageController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [homePageController::class,'index'])->name('web.home.index'); 
Route::get('/admin', [adminPageController::class,'firstpage'])->name('backend.admin'); 
Route::post('/adminlogin', [adminPageController::class, 'postlogin'])->name('backend.login');
Route::get('/dashboard', [adminPageController::class,'dashboard'])->name('adminPanel.admindashboard'); 
Route::get('/newproduct', [adminPageController::class,'product'])->name('adminPanel.newproduct'); 
Route::get('/error', [adminPageController::class,'error'])->name('adminPanel.error'); 
Route::get('/test', [adminPageController::class,'test'])->name('adminPanel.test'); 


Route::get('/addcategory', [categoryController::class,'addcategory'])->name('adminPanel.category'); 
Route::post('ajaxImageUpload', [categoryController::class,'postcategory'])->name('ajaxImageUpload');
Route::get('datarecieve', [categoryController::class,'getData'])->name('admin.category.recieveData');

Route::get('admin/category/{id}/delete', [categoryController::class,'deletecategory'])->name('admin.category.delete');
 






