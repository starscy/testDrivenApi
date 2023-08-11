<?php

namespace Tests\Feature;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function test_a_task_status_can_be_changed(): void
    {
        $task = $this->createTask();

        $this->patchJson(route('task.update', [
            $task->id,
            "status" => TaskStatus::IN_PROGRESS->value
        ]));

        $this->assertDatabaseHas('tasks', [
            'status' => TaskStatus::IN_PROGRESS->value
        ]);
    }
}
