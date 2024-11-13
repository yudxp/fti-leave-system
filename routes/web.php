<?php

use App\Http\Controllers\LeaveRequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/leave-requests/{record}/approve', [LeaveRequestController::class, 'approve'])->name('leave-requests.approve');
Route::get('/leave-requests/{record}/reject', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject');
Route::get('/leave-requests/{record}/print', [LeaveRequestController::class, 'print'])->name('leave-requests.print');
Route::get('/send-email', function () {
    $data = ['name' => 'John Doe'];
    Mail::to('yudha.arzi@ia.itera.ac.id')->send(new SendEmail($data));
    return 'Email sent successfully';
});
