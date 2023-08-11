<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class TodolistController extends Controller
{
    public function index()
    {
        $lists = TodoList::all();
        return response($lists);
    }

    public function show(TodoList $todo_list)
    {

       // $list = TodoList::findOrFail($todo);

        return response($todo_list);
    }

    public function store(TodoListRequest $request)
    {
        $todo_list = $request->validated();

        $todo_list = TodoList::create($todo_list);

        return  $todo_list;

        //return response($list, ResponseAlias::HTTP_CREATED); //Ларавел сам сформирует ответ

    }

    public function update(TodoList $todo_list, TodoListRequest $request)
    {
        $data = $request->validated();

        $todo_list->update($data);

        return  $todo_list;
    }

    public function destroy(TodoList $todo_list)
    {
        $todo_list->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
}
