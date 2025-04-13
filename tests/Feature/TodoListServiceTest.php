<?php

namespace Tests\Feature;

use App\services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodoListServiceTest extends TestCase
{
    private TodolistService $todolistService;

    public function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testExample()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo('1', 'test');

        $todolist =Session::get('todolist');
        foreach ($todolist as $todo) {
            self::assertEquals('1', $todo['id']);
            self::assertEquals('test', $todo['todo']);
        }
    }

    public function testGetTodolistEmpty() {
        self::assertEquals([], $this->todolistService->getTodolist());
    }

    public function testGetTodolistNotEmpty() {
        $expected = [
            [
                'id' => '1',
                'todo' => 'test'
            ],
            [
                'id' => '2',
                'todo' => 'test2'
            ]
        ];

        $this->todolistService->saveTodo('1', 'test');
        $this->todolistService->saveTodo('2', 'test2');

        self::assertEquals($expected, $this->todolistService->getTodolist());
    }

    public function testRemoveTodo() {
        $this->todolistService->saveTodo('1', 'test');
        $this->todolistService->saveTodo('2', 'test2');

        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo('3');

        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo('1');

        self::assertEquals(1, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo('2');

        self::assertEquals(0, sizeof($this->todolistService->getTodolist()));

    }
}
