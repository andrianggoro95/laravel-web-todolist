<?php

namespace App\services\Impl;

use App\services\UserService;

class UserServiceImpl implements UserService
{
    private array $users = [
        "admin" => "admin",
    ];

    function login(string $user, string $password): bool
    {
        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];
        return $password === $correctPassword;
    }
}
