<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\API\BaseController as Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth:api')->only('logout');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $validated['email'])->first();

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'Login successful');
        } else {
            return $this->sendError('Invalid credentials.', ['error' => 'The username or password doesn\'t match our records.'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->remove();

        return $this->sendResponse([], 'Log out succesful!');
    }
}
