<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscordNativeTaskController;

Route::get('/discord-native-tasks', [DiscordNativeTaskController::class, 'index']);
Route::post('/reward-user', [DiscordNativeTaskController::class, 'store']);
