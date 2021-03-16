<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\BaseController as Controller;
use App\Models\Auth\PasswordReset;
use App\Models\User;
use App\Notifications\Auth\PasswordResetRequest;
use App\Notifications\Auth\PasswordResetSuccess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

        /**
     * Create token password reset
     *
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            // 'g-recaptcha-response' => 'recaptcha',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return $this->sendResponse([], 'We have sent you an email with the link to reset your password!');
        }

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60),
            ]
        );

        if ($user && $passwordReset) {
            $user->notify(new PasswordResetRequest($passwordReset->token));
        }

        return $this->sendResponse([], 'We have sent you an email with the link to reset your password!');
    }

    /**
     * Find token password reset
     *
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (! $passwordReset) {
            return $this->sendError('Invalid token.');
        }

        if (Carbon::parse($passwordReset->updated_at)->addDays(3)->isPast()) {
            $passwordReset->delete();

            return $this->sendError('Invalid token.');
        }

        return $this->sendResponse(['token' => $passwordReset], 'Valid token');
    }

    /**
     * Reset password
     *
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => [
                'required',
                'string',
                'min:' . config('user_settings.validations.password.min'),
                'confirmed',
            ],
            'token' => 'required|string',
        ]);

        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email],
        ])->first();

        if (! $passwordReset) {
            return $this->sendError('El token es invalido.');
        }

        $user = User::where('email', $passwordReset->email)->first();

        // TODO: Check if this error message should be sended
        if (! $user) {
            return $this->sendError('Could not find a user with that email.');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess());

        return $this->sendResponse([], 'Password restored successfully!');
    }
}
