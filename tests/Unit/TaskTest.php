<?php

namespace Tests\Unit;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_tasks_belong_to_todo_list(): void
    {
        $todolist = $this->createTodoList();
        $task = $this->createTask([
            'todo_list_id' => $todolist->id
        ]);

        $this->assertInstanceOf(TodoList::class, $task->todoList);
    }
}
