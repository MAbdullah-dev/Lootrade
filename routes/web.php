<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CheckoutController;
use App\Livewire\Admindashboard\AdminWinners;
use App\Livewire\Admindashboard\AdminRaffles;
use App\Livewire\Admindashboard\AdminRaffleUsers;
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
use App\Livewire\Pages\Raffles;
use App\Livewire\Pages\RaffleDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class)->name('welcome');
Route::get('/profile', Profile::class)->name('profile');
Route::get('/mytickets', MyTickets::class)->name('myTickets');
Route::get('/support', Support::class)->name('support');
Route::get('/home', Home::class)->name('home');
Route::get('/raffles', Raffles::class)->name('raffles');
Route::get('/raffle/{id}', RaffleDetail::class)->name('raffle');
Route::get('/tickets', Tickets::class)->name('tickets');


//Admin Dashboard Routes
Route::get('/admin/users', Users::class)->name('admin.users');
Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
Route::get('/admin/raffle', AdminRaffles::class)->name('admin.raffles');
Route::get('/admin/raffles/{raffleId}/users', AdminRaffleUsers::class)
->name('admin.raffle.users');
Route::get('/admin/winners', AdminWinners::class)->name('admin.winners');
Route::get('/admin/transaction', Transaction::class)->name('admin.transaction');
Route::get('/admin/ticketsPackeges', TicketPackages::class)->name('admin.ticketsPackeges');
Route::get('/admin/packageTypes', PackageType::class)->name('admin.packageTypes');

//auth
Route::get('/login', Login::class)->name('login');
//social auth
Route::get('auth/{provider}', [SocialiteController::class, 'redirectToProvider'])
    ->name('auth.redirect')
    ->where('provider', 'google|twitter|discord');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])
    ->name('auth.callback')
    ->where('provider', 'google|twitter|discord');

Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
