<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function() {
    return Auth::check() ? redirect('/dashboard') : redirect('/login');
});


Route::middleware('guest')->group(function() {
    Route::get('/login', function() {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials, $request->boolean('remember'))){
            $request->session()->regenerate();
            return redirect()->route('auth.redirect');
        }

        return back()->withErrors([
            'email'=> 'Email incorreto.',
            'password' => 'Senha incorreta.'
        ]);
    });


    Route::get('/auth/callback', [AuthController::class,'callback'])->name('auth.callback');
    Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class,'register']);
});

Route::get('/auth/redirect', [AuthController::class,'redirectToAuthorization'])->name('auth.redirect');

Route::get('/auth/refresh', [AuthController::class,'refreshToken']);



Route::middleware('auth:web')->group(function() {
    Route::get('/dashboard', function() {

        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', function(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

    Route::get('/cadastrarPaciente', function() {
        return view('pacientes.CadastrarPacientes');
    })->name('cadastrarPaciente');

    
});


