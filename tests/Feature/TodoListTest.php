<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    private $list;

    public function setUp(): void
    {
        parent::setUp();

        $this->list = $this->createTodoList([
            'name' => 'test API first'
        ]);
    }

    public function test_index_todo_list(): void
    {
        $response = $this->getJson(route('todo-list.index'));

        $this->assertEquals(1, count($response->json()));
        $this->assertEquals('test API first', $response->json()[0]['name']);
    }

    public function test_fetch_single_todo_list(): void
    {
        $response = $this->getJson(route('todo-list.show', $this->list->id))
            ->assertOk()
            ->json();

        $this->assertEquals($this->list->name, $response['name']);
    }

    public function test_store_new_todo_list(): void
    {
        $list = TodoList::factory()->make();

        $response = $this->postJson(route('todo-list.store',
            [
                'name' => $list->name
            ]))
            ->assertCreated()
            ->json();

        $this->assertEquals($list->name, $response['name']
        );
        $this->assertDatabaseHas('todo_lists', [
            'name' => $list->name
        ]);
    }

    public function test_while_storing_name_field_is_require()
    {
        $this->withExceptionHandling();
        $response = $this->postJson(route('todo-list.store'))
            ->assertUnprocessable(); //->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_update_todo_list()
    {
        $this->patchJson(route('todo-list.update', [
            $this->list->id,
            'name' => 'this todo list PATCHED'
        ]))
            ->assertOk();
        $this->assertDatabaseHas('todo_lists', [
            'name' => 'this todo list PATCHED'
        ]);
    }

    public function test_while_updating_name_field_is_require()
    {
        $this->withExceptionHandling();

        $response = $this->patchJson(route('todo-list.update',
            $this->list->id))
            ->assertUnprocessable(); //->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }


    public function test_delete_todo_list_with_all_its_tasks()
    {
        $task = $this->createTask([
            'todo_list_id' => $this->list->id
        ]);
        $taskBeInBase = $this->createTask();

        $this->deleteJson(route('todo-list.destroy', $this->list->id));

        $this->assertDatabaseMissing('todo_lists', [
            $this->list->id
        ])
            ->assertDatabaseMissing('tasks', [
                'id' => $task->id
            ])
            ->assertDatabaseHas('tasks', [
                'id' => $taskBeInBase->id
            ]);

    }
}
