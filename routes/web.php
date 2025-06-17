<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CheckoutController;
use App\Livewire\Admindashboard\AdminWinners;
use App\Livewire\Admindashboard\AdminRaffles;
use App\Livewire\Admindashboard\AdminRaffleUsers;
use App\Livewire\Admindashboard\Dashboard;
use App\Livewire\Admindashboard\NewsletterSubscription;
use App\Livewire\Admindashboard\PackageType;
use App\Livewire\Admindashboard\TicketPackages;
use App\Livewire\Admindashboard\Transaction;
use App\Livewire\Admindashboard\Users;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Dashboard\ChangePassword;
use App\Livewire\Dashboard\MyTickets;
use App\Livewire\Dashboard\Profile;
use App\Livewire\Dashboard\Support;
use App\Livewire\Dashboard\UserRaffles;
use App\Livewire\Dashboard\UserTransaction;
use App\Livewire\Faq;
use App\Livewire\Pages\Battlefield;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Tickets;
use App\Livewire\Welcome;
use App\Livewire\Pages\Raffles;
use App\Livewire\Pages\RaffleDetail;
use App\Livewire\Pages\RaffleForm;
use App\Livewire\Pages\SoloPlay;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;


Route::get('/', Welcome::class)->name('welcome');
Route::get('/faq', Faq::class)->name('faq');
Route::get('/profile', Profile::class)->name('profile');
Route::get('/mytickets', MyTickets::class)->name('myTickets');
Route::get('/support', Support::class)->name('support');
Route::get('/home', Home::class)->name('home');
Route::get('/raffles', Raffles::class)->name('raffles');
Route::get('/raffle/{id}', RaffleDetail::class)->name('raffle');
Route::get('/tickets', Tickets::class)->name('tickets');
Route::get('/user/transactions',UserTransaction::class)->name('user.transactions');
Route::get('/user/raffles',UserRaffles::class)->name('user.raffles');
Route::get('/user/change/password',ChangePassword::class)->name('user.change.password');
//game
Route::get('/raffle/{raffle}/game/solo', SoloPlay::class)->name('game.solo');
Route::get('/raffle/{raffle}/game/battle', Battlefield::class)->name('game.battle');
//game end


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
Route::get('/admin/newsletter', NewsletterSubscription::class)->name('admin.newsletter');

// admin raffle create update
Route::get('/admin/raffle/create', RaffleForm::class)->name('raffle.create');
Route::get('/admin/raffle/edit/{id}', RaffleForm::class)->name('raffle.edit');
// end admin raffle create update

//auth
Route::get('/login', Login::class)->name('login');
//social auth
Route::get('auth/{provider}', [SocialiteController::class, 'redirectToProvider'])
    ->name('auth.redirect')
    ->where('provider', 'google|twitter|discord|kick|twitch');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])
    ->name('auth.callback')
    ->where('provider', 'google|twitter|discord|kick|twitch');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');


// Route::get('/reset-password/{token}', function ($token) {
//     return view('auth.reset-password', ['token' => $token]);
// })->name('password.reset');

Route::get('reset-password/{token}/{email}', ResetPassword::class)->name('password.reset');

// Redirect to login after verification
Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::findOrFail($id);

    // Verify the email hash
    if (! hash_equals((string) $hash, (string) sha1($user->getEmailForVerification()))) {
        abort(403, 'This action is unauthorized.');
    }

    // Mark the email as verified
    if ($user->markEmailAsVerified()) {
        event(new Verified($user)); // Dispatch Verified event
    }

    // Redirect after verification
    return redirect()->route('login');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Send verification email after registration
Route::get('/email/resend', 'Auth\VerificationController@resend')->middleware(['auth'])->name('verification.resend');
