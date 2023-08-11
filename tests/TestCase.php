<?php

namespace Tests;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    public function createTodoList(array $data = [])
    {
        return TodoList::factory()->create($data);
    }

    public function createTask(array $data=[])
    {
        return Task::factory()->create($data);
    }
}
