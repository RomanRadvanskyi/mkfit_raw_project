<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'homepage']);

Route::middleware('auth')->group(function () {

    Route::post('/order-single-membership', [MembershipController::class, 'orderSingleMembership'])->name('order.single.membership');
    Route::post('/order-monthly-membership', [MembershipController::class, 'orderMonthlyMembership'])->name('order.monthly.membership');
    Route::get('/view-membership-status', [MembershipController::class, 'viewMembershipStatus'])->name('view.membership.status');
    Route::delete('/delete-membership', [MembershipController::class, 'deleteMembership'])->name('delete.membership');

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'viewMemberships'])->name('admin.adminhome');

    Route::get('/admin-cards', [CardController::class, 'index'])->name('admin.cards');
    Route::post('/admin-cards', [CardController::class, 'store'])->name('admin.cards.store');

    Route::put('/admin/cards/{card}', [CardController::class, 'update'])->name('admin.cards.update');
    Route::delete('/admin/cards/{id}', [CardController::class, 'deleteCard'])->name('admin.cards.delete');

    Route::post('/admin/pay-membership/{id}', [AdminController::class, 'payMembership'])->name('admin.pay.membership');
    Route::post('/admin/cancel-membership/{id}', [AdminController::class, 'cancelMembership'])->name('admin.cancel.membership');
    Route::get('/admin/check/membership/{cardId}', [AdminController::class, 'checkMembershipCardId']);
    Route::put('/admin/edit/membership/{membershipId}', [AdminController::class, 'updateMembership']);
});

require __DIR__.'/auth.php';
