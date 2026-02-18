<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', '/home');

Route::get('register', [\App\Http\Controllers\LoginRegisterController::class, 'register'])->name('register');
Route::post('register', [\App\Http\Controllers\LoginRegisterController::class, 'register_action'])->name('register.action');
Route::get('login', [\App\Http\Controllers\LoginRegisterController::class, 'login'])->name('login');
Route::post('login', [\App\Http\Controllers\LoginRegisterController::class, 'login_action'])->name('login.action');
Route::get('forgot-password', [\App\Http\Controllers\LoginRegisterController::class, 'password'])->name('password');
Route::post('forgot-password', [\App\Http\Controllers\LoginRegisterController::class, 'password_action'])->name('password.action');
Route::get('logout', [\App\Http\Controllers\LoginRegisterController::class, 'logout'])->name('logout');
Route::get('reset-password/{token}', [\App\Http\Controllers\LoginRegisterController::class, 'reset_form'])->name('reset.password');
Route::post('reset-password', [\App\Http\Controllers\LoginRegisterController::class, 'reset'])->name('reset.action');

// admin - setting &reference
Route::get('/setting-country', \App\Http\Livewire\SettingCountry::class)->middleware('auth');
Route::get('/setting-requirement', \App\Http\Livewire\SettingRequirement::class)->middleware('auth');
Route::get('/setting-tour', \App\Http\Livewire\SettingTour::class)->middleware('auth');
Route::get('/setting-service-deal', \App\Http\Livewire\SettingPromo::class)->middleware('auth');
Route::get('/setting-partner', \App\Http\Livewire\SettingPartner::class)->middleware('auth');
Route::get('/setting-testimony', \App\Http\Livewire\SettingTestimoni::class)->middleware('auth');
Route::get('/setting-carousel', \App\Http\Livewire\SettingCarousel::class)->middleware('auth');
Route::get('/setting-homepage', \App\Http\Livewire\SettingHomepage::class)->middleware('auth');
Route::get('/setting-flight', \App\Http\Livewire\SettingFlight::class)->middleware('auth');
// admin - data
Route::get('/request', \App\Http\Livewire\Request::class)->middleware('auth');
// homepage
Route::get('/home', \App\Http\Livewire\Home::class);
// document - passport
Route::get('/passport', \App\Http\Livewire\DisplayPassport::class);
// document - visa
Route::get('/visa', \App\Http\Livewire\DisplayVisa::class);
Route::get('/visa-requirement', \App\Http\Livewire\DisplayVisaRequirement::class);
Route::get('/free-visa', \App\Http\Livewire\DisplayVisaFree::class);
Route::get('/visa-not-process', \App\Http\Livewire\DisplayCantProcess::class);
Route::get('/visa-requirement/{slug}', \App\Http\Livewire\DetailRequirement::class);
// document - indonesian visa
Route::get('/indonesian-visa', \App\Http\Livewire\IndonesianVisa::class);
Route::get('/visa-index-b211', \App\Http\Livewire\VisaIndex::class);
Route::get('/visa-index-b213', \App\Http\Livewire\VisaIndex::class);
Route::get('/visa-index-c312', \App\Http\Livewire\VisaIndex::class);
Route::get('/visa-index-c3134', \App\Http\Livewire\VisaIndex::class);
Route::get('/visa-index-c317', \App\Http\Livewire\VisaIndex::class);
Route::get('/visa-index-c318', \App\Http\Livewire\VisaIndex::class);
Route::get('/visa-index-c319', \App\Http\Livewire\VisaIndex::class);
Route::get('/visa-index-d212', \App\Http\Livewire\VisaIndex::class);
Route::get('/visa-index-epo', \App\Http\Livewire\VisaIndex::class);
// tour - recommendation, favourite, all, detail
Route::get('/tour/recommendation', \App\Http\Livewire\Tour::class);
Route::get('/tour/favourite', \App\Http\Livewire\Tour::class);
Route::get('/tour/all', \App\Http\Livewire\Tour::class);
Route::post('/tour/all/{keyword}', \App\Http\Livewire\SearchTour::class);
Route::get('/tour/detail/{slug}', \App\Http\Livewire\DetailTour::class);
Route::get('/tour/{slug}', \App\Http\Livewire\TourPackage::class);
// best deal
Route::get('/service-deal', \App\Http\Livewire\BestDeal::class);

