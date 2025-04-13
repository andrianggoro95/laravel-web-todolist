<?php

namespace Tests\Feature;

use App\services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSuccess()
    {
        $result = $this->userService->login('admin', 'admin');
        self::assertTrue($result);
    }

    public function testLoginUserNotFound()
    {
        $result = $this->userService->login('user', 'user');
        self::assertFalse($result);
    }

    public function testLoginWrongPassword()
    {
        $result = $this->userService->login('admin', 'wrong');
        self::assertFalse($result);
    }
}
