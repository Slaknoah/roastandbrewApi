<?php

use App\Http\Controllers\API\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\EmailVerificationController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/user', [UsersController::class, 'show']);

    Route::post('email/verify/{id}', [EmailVerificationController::class, 'verify'])
        ->name('verificationApi.verify');

    Route::post('/email/resend', [EmailVerificationController::class, 'resend']);

    /**
     * Company Routes
     */
    Route::apiResource('companies', CompanyController::class);
});
