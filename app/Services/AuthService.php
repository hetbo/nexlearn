<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function registerUser(array $data): User
    {
        return $this->userService->createUser($data);
    }

    public function login(array $credentials): bool
    {
        $field = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        $authCredentials = [
            $field => $credentials['identifier'],
            'password' => $credentials['password'],
        ];

        $remember = $credentials['remember'] ?? false;

        return Auth::attempt($authCredentials, $remember);
    }

}
