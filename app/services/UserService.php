<?php

namespace App\services;

interface UserService
{
    function login(string $user, string $password): bool;
}
