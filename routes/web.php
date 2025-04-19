<?php

use App\Livewire\HomePage;
use App\Livewire\CategoriesPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\CartPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ForgotPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CheckoutPage;
use App\Livewire\CancelPage;
use App\Livewire\SuccessPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\MyOrdersDetailPage;
use Illuminate\Support\Facades\Route;

Route::get('/',HomePage::class);
Route::get('/categories',CategoriesPage::class);
Route::get('/products',ProductsPage::class);
Route::get('/cart',CartPage::class);
Route::get('/products/{slug}',ProductDetailPage::class);

Route::get('/checkout',CheckoutPage::class);
Route::get('/my-orders',MyOrdersPage::class);
// Route::get('/my-orders-detail',MyOrdersDetailPage::class);
Route::get('/my-orders/{order}',MyOrdersDetailPage::class);

Route::get('/login',LoginPage::class);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::get('/register',RegisterPage::class);
Route::get('/forgot',ForgotPage::class);
Route::get('/reset{token}',ResetPasswordPage::class)->name('password.reset');

Route::get('/cancel',CancelPage::class);
Route::get('/success',SuccessPage::class);
