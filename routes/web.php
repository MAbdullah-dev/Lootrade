<?php

use App\Livewire\Admindashboard\AdminRaffles;
use App\Livewire\Admindashboard\Dashboard;
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

Route::get('/', Welcome::class)->name('login');
Route::get('/login', Login::class);
Route::get('/profile', Profile::class)->name('profile');
Route::get('/mytickets', MyTickets::class)->name('myTickets');
Route::get('/support', Support::class)->name('support');
Route::get('/home', Home::class)->name('home');
Route::get('/raffles', Raffles::class)->name('raffles');
Route::get('/tickets', Tickets::class)->name('tickets');


//Admin Dashboard Routes
Route::get('/admin/users', Users::class)->name('admin.users');
Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
Route::get('/admin/dashboard', AdminRaffles::class)->name('admin.dashboard');

