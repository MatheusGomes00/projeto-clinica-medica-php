<?php

namespace App\Http\Controllers\Auth;

use App\Http\Enum\Especialidades;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;

class RegisterController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function  showRegistrationForm(){
        return view('auth.register');
    }

    public function register(Request $request) {

        $validated = $request->validate([
            'name' => 'required', 'string', 'max:100',
            'email' => 'required', 'string', 'email', 'max:100', 'unique:users',
            'password' => 'required', 'string', 'min:6', 'confirmed',
            'especialidade' => 'string', new Enum(Especialidades::class),

        ]);

        $this->userService->createUser($validated);
        return redirect('/login');
    }
}
