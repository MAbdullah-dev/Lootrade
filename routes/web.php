<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard\MyTickets;
use App\Livewire\Dashboard\Profile;
use App\Livewire\Dashboard\Support;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Tickets;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class)->name('login');
Route::get('/login', Login::class);
Route::get('/profile', Profile::class)->name('profile');
Route::get('/mytickets', MyTickets::class)->name('myTickets');
Route::get('/support', Support::class)->name('support');
Route::get('/home', Home::class)->name('home');
Route::get('/tickets', Tickets::class)->name('tickets');
