<?php

use App\Http\Controllers\LeaveRequestController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/leave-requests/{record}/approve', [LeaveRequestController::class, 'approve'])->name('leave-requests.approve');
Route::get('/leave-requests/{record}/reject', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject');
Route::get('/leave-requests/{record}/print', [LeaveRequestController::class, 'print'])->name('leave-requests.print');