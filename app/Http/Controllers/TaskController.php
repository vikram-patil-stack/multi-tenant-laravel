<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $allTaskss = (new Task())->getAll();
        return response()->json([
            'message' => 'Tasks retrieved successfully',
            'data' => $allTaskss
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : JsonResponse
    {
        $isInserted = (new Task())->insert([
            'name' => 'Sample Task',
            'status' => 1
        ]);

        if ($isInserted) {
            return response()->json([
                'message' => 'Task created successfully'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed to create task'
            ], 500);
        }
    }

}
