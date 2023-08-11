<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    public function test_todo_list_has_many_tasks(): void
    {
        $todolist = $this->createTodoList();
        $task = $this->createTask([
            'todo_list_id' => $todolist->id
        ]);

        $this->assertInstanceOf(Collection::class, $todolist->tasks);
        $this->assertInstanceOf(Task::class, $todolist->tasks->first());
    }
}
