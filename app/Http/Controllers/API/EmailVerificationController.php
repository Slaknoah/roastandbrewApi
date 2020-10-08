<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
class EmailVerificationController extends Controller
{
    use VerifiesEmails;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function show()
    {
    }

    public function verify(Request $request)
    {
        if ( $request->route('id') == $request->user()->getKey() && $request->user()->markEmailAsVerified() ) {
            event(new Verified($request->user()));

            return response()->json('Email verified');
        } else {
            return response()->json('Email failed to verify', 400);
        }
    }

    public function resend(Request $request)
    {
        if ( $request->user()->hasVerifiedEmail() ) {
            return response()->json('User has already verified email!', 422);
        }

        $request->user()->sendApiEmailVerificationNotification();

        return response()->json('Please check your email to verify');
    }
}
