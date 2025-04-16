<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Livewire\Admindashboard\AdminWinners;
use App\Livewire\Admindashboard\AdminRaffles;
use App\Livewire\Admindashboard\Dashboard;
use App\Livewire\Admindashboard\PackageType;
use App\Livewire\Admindashboard\TicketPackages;
use App\Livewire\Admindashboard\Transaction;
use App\Livewire\Admindashboard\Users;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard\MyTickets;
use App\Livewire\Dashboard\Profile;
use App\Livewire\Dashboard\Support;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Tickets;
use App\Livewire\Welcome;
use App\Livewire\Raffles;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class)->name('welcome');
Route::get('/profile', Profile::class)->name('profile');
Route::get('/mytickets', MyTickets::class)->name('myTickets');
Route::get('/support', Support::class)->name('support');
Route::get('/home', Home::class)->name('home');
Route::get('/raffles', Raffles::class)->name('raffles');
Route::get('/tickets', Tickets::class)->name('tickets');


//Admin Dashboard Routes
Route::get('/Admin/users', Users::class)->name('admin.users');
Route::get('/Admin/dashboard', Dashboard::class)->name('admin.dashboard');
Route::get('/Admin/raffle', AdminRaffles::class)->name('admin.raffles');
Route::get('/Admin/winners', AdminWinners::class)->name('admin.winners');
Route::get('/Admin/transaction', Transaction::class)->name('admin.transaction');
Route::get('/Admin/ticketsPackeges', TicketPackages::class)->name('admin.ticketsPackeges');
Route::get('/Admin/packageTypes', PackageType::class)->name('admin.packageTypes');

//auth
Route::get('/login', Login::class)->name('login');
//social auth
Route::get('auth/{provider}', [SocialiteController::class, 'redirectToProvider'])
    ->name('auth.redirect')
    ->where('provider', 'google|twitter|discord');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])
    ->name('auth.callback')
    ->where('provider', 'google|twitter|discord');

    Route::get('/checkout/success', function () {
        return 'Payment successful! 🎉';
    })->name('checkout.success');

    Route::get('/checkout/cancel', function () {
        return 'Payment cancelled.';
    })->name('checkout.cancel');
