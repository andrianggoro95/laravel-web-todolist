<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testHomePageGuest()
    {
        $this->get('/')
            ->assertRedirect('/login');
    }

    public function testHomePageMember()
    {
        $this->withSession([
            'user' => 'admin'
        ])->get('/')
            ->assertRedirect('/todolist');
    }
}
