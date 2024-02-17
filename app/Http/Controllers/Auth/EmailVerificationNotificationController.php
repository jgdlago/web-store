<?php

namespace App\Http\Controllers\Auth;

use App\Http\Responses\HasEmailResponse;
use App\Http\Responses\SendEmailResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController as BaseController;

class EmailVerificationNotificationController extends BaseController
{
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return app(HasEmailResponse::class);
        }

        $request->user()->sendEmailVerificationNotification();

        return app(SendEmailResponse::class);
    }
}
