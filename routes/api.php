<?php

use App\Http\Controllers\API\BrewMethodController;
use App\Http\Controllers\API\CafeController;
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

    /**
     * Cafe Routes
     */
    Route::get( '/companies/{company}/cafes', [ CafeController::class, 'index'] );
    Route::post( '/companies/{company}/cafes', [ CafeController::class, 'store'] );
    Route::get( '/companies/{company}/cafes/{cafe}', [ CafeController::class, 'show'] );
    Route::put( '/companies/{company}/cafes/{cafe}', [ CafeController::class, 'update'] );
    Route::delete( '/companies/{company}/cafes/{cafe}', [ CafeController::class, 'destroy'] );

    /**
     * Brew method routes
     */
    Route::get( '/brew-methods', [BrewMethodController::class, 'index'] );
});
