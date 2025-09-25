<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Exceptions\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Token;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function redirectToAuthorization(Request $request)
    {
        if (!$request->session()->has('state')) {
            $state = Str::random(40);
            $request->session()->put('state', $state);
        } else {
            $state = $request->session()->get('state');
        }

        $query = http_build_query([
            'client_id' => config('services.passport.client_id'),
            'redirect_uri' => config('services.passport.redirect_uri'),
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
        ]);

        return redirect(config('app.url') . '/oauth/authorize?' . $query);
    }

    public function callback(Request $request)
    {
        try{
        $sessionState = $request->session()->pull('state');
        $requestState = $request->state;
        //dd($sessionState, $requestState);
        if (!$sessionState || $sessionState != $requestState) {
            Auth::logout();
            return redirect('/login')->withErrors(['error' => 'Falha na autenticação. Estados incorretos']);

        }

        $response = Http::asForm()->post('http://localhost:8000/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'redirect_uri' => config('services.passport.redirect_uri'),
            'code' => $request->code,
        ]);

        if ($response->failed()) {
            return back()->withErrors(['oauth' => 'Falha ao autorizar.']);
        }

        return $response->json();

        } catch (\Exception $e) {
            redirect()->route('dashboard');
            return redirect('dashboard')->withErrors(['Será que foi?'=> $e->getMessage()]);
        }
    }

    public function refreshToken(Request $request)
    {
        $refreshToken = $request->refresh_token ?? $request->session()->get('oauth_refresh_token');

        if (!$refreshToken) {
            return response()->json(['error' => "Refresh token não fornecido."], 400);
        }

        $response = Http::asForm()->post(config('app.url') . '/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'scope' => '',
        ]);
        if($response->successful()) {
            $tokens = $response->json();

            $request->session()->put([
                'oauth_access_token' => $tokens['access_token'],
                'oauth_refresh_token' => $tokens['refresh_token'] ?? null,
                'oauth_expires_in' => $tokens['expires_in'] ?? 36000,
            ]);
            return $response->json($tokens);
        }
        return response()->json([
            'error' => 'Falha ao renovar token.',
            'details' => $response->json()
        ], $response->status());

    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $token = $user->token;
            if($token) {
                $token->revoke();

                if($token->refreshToken) {
                    $token->refreshToken->revoke();
                }
            }
        }
        $request->session()->forget([
            'oauth_access_token',
            'oauth_refresh_token',
            'oauth_expires_in'
        ]);
        Auth::logout();
        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }
}
