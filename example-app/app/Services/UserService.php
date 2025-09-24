<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class UserService
{
    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'password'=> bcrypt($data['password']),
            'especialidade' => $data['especialidade']
        ]);
        // return Response::json($user, $status=200);
    }
}
