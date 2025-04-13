<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodoList()
    {
        $this->withSession([
            'user' => 'admin',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'test'
                ],
                [
                    'id' => '2',
                    'todo' => 'test2'
                ]
            ]

        ])->get('/todolist')
            ->assertSeeText('1')
            ->assertSeeText('test')
            ->assertSeeText('2')
            ->assertSeeText('test2');
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            'user' => 'admin'
        ])->post('/todolist', [])
            ->assertSeeText('Todo is required');
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            'user' => 'admin'
        ])->post('/todolist', ['todo' => 'test'])
            ->assertRedirect('/todolist');
    }

    public function testRemoveTodolist() {
        $this->withSession([
            'user' => 'admin',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'test'
                ],
                [
                    'id' => '2',
                    'todo' => 'test2'
                ]
            ]
        ])->post('/todolist/1/delete')
            ->assertRedirect('/todolist');
    }
}
