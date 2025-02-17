<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreToDoRequest;
use App\Http\Requests\UpdateToDoRequest;
use App\Models\ToDo;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return auth()->user()->todos;
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreToDoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreToDoRequest $request): JsonResponse
    {
        try {
            $todo = auth()->user()->todos()->create($request->validated());
            return response()->json($todo, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create a new to do'], 500);
        }
    }

    /**
     * Display the specified to-do item.
     * @param ToDo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ToDo $todo): JsonResponse
    {
        Gate::authorize('show', $todo);
        return response()->json($todo, 200);
    }


    /**
     * Update the specified to-do item.
     * @param UpdateToDoRequest $request
     * @param ToDo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateToDoRequest $request, ToDo $todo): JsonResponse
    {
        Gate::authorize('update', $todo);
        $todo->update($request->validated());
        return response()->json(data: $todo, status: 201);
    }

    /**
     * Remove the specified to-do item.
     * @param ToDo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ToDo $todo): JsonResponse
    {
        Gate::authorize('delete', $todo);
        $deletedToDo = $todo->replicate();
        $todo->delete();
        return response()->json(data: $deletedToDo, status: 200);
    }
}