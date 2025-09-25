<?php

namespace App\Services;

use App\Models\User;

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

}
