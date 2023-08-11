<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private $todoList;
    private $task;

    public function setUp(): void
    {
        parent::setUp();
        $this->todoList = $this->createTodoList();
        $this->task = $this->createTask([
            'todo_list_id' => $this->todoList->id
        ]);
    }

    public function test_fetch_all_tasks_of_a_todo_list()
    {
        $this->createTodoList();
        $this->createTask([
            'todo_list_id' => 2,
        ]);

        $response = $this->getJson(route('todo-list.task.index', $this->todoList->id))
            ->assertOk()
            ->json();

        $this->assertEquals(1, count($response));
        $this->assertEquals($this->task->title, $response[0]['title']);
        $this->assertEquals($response[0]['todo_list_id'], $this->todoList->id);
    }

    public function test_store_a_task_of_a_todo_list()
    {
        $task = Task::factory()->create();

        $response = $this->postJson(route('todo-list.task.store', $this->todoList->id), [
            "title" => $task->title,
            "todo_list_id" => $this->todoList->id
        ])
            ->assertCreated()
            ->json();

        $this->assertEquals($task->title, $response['title']
        );
        $this->assertDatabaseHas('tasks', [
            'title' => $task->title,
            'todo_list_id' => $this->todoList->id,
        ]);
    }

    public function test_update_a_task_of_a_todo_list()
    {
        $response = $this->patchJson(route('task.update', [
            $this->task->id,
            'title' => 'updated task',
        ]))
        ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'title' => $response['title']
        ]);
    }


    public function test_delete_a_task_from_database()
    {
        $this->deleteJson(route('task.destroy', $this->task->id
        ))
            ->assertNoContent();

        $this->assertDatabaseMissing('tasks', [
            'id' => $this->task->id
        ]);
    }

}
