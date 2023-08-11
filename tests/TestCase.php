<?php

namespace Tests;

use App\Models\Task;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,
        DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    public function createTodoList(array $data = [])
    {
        return TodoList::factory()->create($data);
    }

    public function createTask(array $data = [])
    {
        return Task::factory()->create($data);
    }

    public function createUser(array $data = [])
    {
        return User::factory()->create($data);
    }
}
