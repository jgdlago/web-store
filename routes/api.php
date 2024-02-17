<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\{AuthenticatedSessionController,
    RegisteredUserController,PasswordResetLinkController, PasswordController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('auth')->withoutMiddleware('auth:sanctum')->group(function () {
        $limiter = config('fortify.limiters.login');

        Route::post('/login', [AuthenticatedSessionController::class, 'store'])
            ->middleware(array_filter([
                'guest:'.config('fortify.guard'),
                $limiter ? 'throttle:'.$limiter : null,
            ]));

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest:'.config('fortify.guard'));

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->middleware('guest:'.config('fortify.guard'))
            ->name('password.email');

        $verificationLimiter = config('fortify.limiters.verification', '6,1');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware([
                'throttle:'.$verificationLimiter
            ]);
    });


    Route::prefix('user')->middleware('verified')->group(function () {
        Route::put('/update-password', [PasswordController::class, 'update']);
    });
});
