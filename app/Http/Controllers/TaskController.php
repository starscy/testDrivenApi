<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function index(TodoList $todoList)
    {
        $tasks = Task::where([
            'todo_list_id' => $todoList->id
        ])->get();

        return response($tasks);
    }

    public function store(TodoList $todoList, Request $request,)
    {
        // $request['todo_list_id']  = $todoList->id;
        $data = $request->validate([
            'title' => 'required',
            'todo_list_id' => '',
        ]);
        $task = Task::create($data);

        return response($task, Response::HTTP_CREATED);
    }

    public function update(Task $task, Request $request)
    {
        $task->update($request->all());

        return response($task);
    }


    public function destroy(Task $task)
    {
        return response($task->delete(), Response::HTTP_NO_CONTENT);
    }
}
