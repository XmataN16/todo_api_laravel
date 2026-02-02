<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Response;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Просмотр списка всех задач
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    /**
     * Создание новой задачи
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        $task = Task::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Задача успешно создана',
            'data' => $task
        ], Response::HTTP_CREATED);
    }

    /**
     * Просмотр одной задачи
     */
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена',
                'error' => 'Task not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    /**
     * Обновление задачи
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена',
                'error' => 'Task not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validated();

        $task->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Задача успешно обновлена',
            'data' => $task
        ]);
    }

    /**
     * Удаление задачи
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена',
                'error' => 'Task not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Задача успешно удалена'
        ]);
    }
}
