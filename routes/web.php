<?php

use App\Http\Controllers\CompanyGen;
use App\Http\Controllers\MembershipGen;
use App\Http\Controllers\MembershipModuleGen;
use App\Http\Controllers\ModuleGen;
use App\Http\Controllers\UserModuleGen;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::group(['middleware' => ['auth']], function (){

    //GENISA
    Route::get('/maketemplate', [\App\Http\Controllers\MakeTemplateController::class, 'index'])->name('maketemplate');
    Route::post('/maketemplatecontroller/toFile/', [\App\Http\Controllers\MakeTemplateController::class, 'toFile'])->name('maketemplatecontroller.toFile');
    Route::post('/maketemplatecontroller/inicializar/', [\App\Http\Controllers\MakeTemplateController::class, 'inicializar'])->name('maketemplatecontroller.inicializar');
    //------

    //sys_facturacion controllers
    Route::get('/membershipgen', [MembershipGen::class, 'index'])->name('membershipgen');
    Route::get('/modulegen', [ModuleGen::class, 'index'] )->name('modulegen');
    Route::get('/user_modulegen', [UserModuleGen::class, 'index' ] )->name('user_modulegen');
    Route::get('/membership_modulegen', [MembershipModuleGen::class, 'index' ] )->name('membership_modulegen');
    Route::get('/companygen', [CompanyGen::class, 'index'] )->name('companygen');
    Route::get('/installmentgen', [\App\Http\Controllers\InstallmentGen::class, 'index'] )->name('installmentgen');
    Route::get('/installmentgencd', [\App\Http\Controllers\InstallmentGenCD::class, 'index'] )->name('installmentgencd');
    Route::get('/detailinstallmentgen', [\App\Http\Controllers\DetailInstallmentGen::class, 'index'] )->name('detailinstallmentgen');
    Route::get('/notegen', [\App\Http\Controllers\NoteGen::class, 'index'] )->name('notegen');
    Route::get('/notedetailgen', [\App\Http\Controllers\NoteDetailGen::class, 'index'] )->name('notedetailgen');

    Route::get('/taxgen', [\App\Http\Controllers\TaxGen::class, 'index'])->name('taxgen');
    Route::get('/categorygen', [\App\Http\Controllers\CategoryGen::class, 'index'])->name('categorygen');
    Route::get('/measuregen', [\App\Http\Controllers\MeasureGen::class, 'index'])->name('measuregen');
    Route::get('/suppliergen', [\App\Http\Controllers\SupplierGen::class, 'index'])->name('suppliergen');
    Route::get('/clientgen', [\App\Http\Controllers\ClientGen::class, 'index'])->name('clientgen');
    Route::get('/salegen', [\App\Http\Controllers\SaleGen::class, 'index'])->name('salegen');
    Route::get('/productgen', [\App\Http\Controllers\ProductGen::class, 'index'])->name('productgen');
    Route::get('/producttaxgen', [\App\Http\Controllers\ProductTaxGen::class, 'index'])->name('producttaxgen');
    Route::get('/saledetailgen', [\App\Http\Controllers\SaleDetailGen::class, 'index'])->name('saledetailgen');
    Route::get('/purchasegen', [\App\Http\Controllers\PurchaseGen::class, 'index'])->name('purchasegen');
    Route::get('/movementgen', [\App\Http\Controllers\MovementGen::class, 'index'])->name('movementgen');

    //Validaciones request
  //  Route::resource('localidad', 'LocalidadController');

});

