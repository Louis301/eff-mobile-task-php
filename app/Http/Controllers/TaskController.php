<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    // Просмотр списка задач (GET /tasks)
    public function index(): JsonResponse
    {
        return response()->json(Task::all());
    }

    // Создание задачи (POST /tasks)
    public function store(Request $request): JsonResponse
    {
        // Валидация (Требование №3)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:new,in_progress,done', // Пример ограничений статуса
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201);
    }

    // Просмотр одной задачи (GET /tasks/{id})
    public function show($id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    // Обновление задачи (PUT /tasks/{id})
    public function update(Request $request, $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:new,in_progress,done',
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    // Удаление задачи (DELETE /tasks/{id})
    public function destroy($id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}