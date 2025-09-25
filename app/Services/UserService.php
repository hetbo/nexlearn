<?php

namespace App\Services;

use App\Models\User;

class UserService {

    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'mobile' => $data['mobile'],
            'password' => $data['password'],
            'role' => $data['role'],
        ]);
    }
}
