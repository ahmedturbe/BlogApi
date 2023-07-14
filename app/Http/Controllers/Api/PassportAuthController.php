<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;
use App\Http\Requests\StoreUserRequest;

class PassportAuthController extends Controller
{
     /**
     * Registration Req
     */
    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('Laravel8PassportAuth')->accessToken;

         return response()->json(['token' => $token], 200);
    }

    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel8PassportAuth')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function logout(Request $request, TokenRepository $tokenRepository)
    {
    $user = $request->user();

    // Prvo, provjerite je li korisnik prijavljen
    if ($user) {
        // Zatim dohvatite trenutni pristupni token korisnika
        $accessToken = Auth::user()->token();

        // Ako postoji pristupni token, povucite ga iz baze podataka
        if ($accessToken) {
            $tokenRepository->revokeAccessToken($accessToken->id);
        }
    }

    return response()->json(['message' => 'Successfully logged out']);
}

    public function userInfo()
    {

     $user = auth()->user();

     return response()->json(['user' => $user], 200);

    }
}
