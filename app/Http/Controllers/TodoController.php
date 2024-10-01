<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $todos = Todo::all();
            return view('index', compact('todos'));
        } catch (Exception $e) {
            Log::error('Error fetching todo list: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Error fetching todo list'
            ], 500);
        }
    }

    /**
     * Store or update a todo resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'responsible' => 'required|string|max:255',
            'employee' => 'required', // Assuming procedures is an array
            'procedures' => 'required', // Assuming procedures is an array
            'todoId' => 'nullable|integer|exists:todos,id' // Optional for update
        ]);

        try {
            // Use validated data and JSON encode the procedures field
            $todo = Todo::updateOrCreate(
                ['id' => $validated['todoId'] ?? null],
                [
                    'responsible' => $validated['responsible'],
                    'employee' => $validated['employee'],
                    'procedures' => json_encode($validated['procedures']),
                ]
            );

            return response()->json([
                'status' => 'success',
                'data' => $todo
            ], 201);
        } catch (Exception $e) {
            Log::error('Error creating/updating todo: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Error creating/updating todo'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Todo $todo)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $todo
            ], 200);
        } catch (Exception $e) {
            Log::error('Error fetching the todo: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Error fetching the todo'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Todo $todo)
    {
        try {
            $todo->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Todo deleted successfully'
            ], 200);
        } catch (Exception $e) {
            Log::error('Error deleting the todo: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Error deleting the todo'
            ], 500);
        }
    }
}
