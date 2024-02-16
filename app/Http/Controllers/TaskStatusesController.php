<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TaskStatus as TaskStatusModel;

class TaskStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskStatuses = TaskStatusModel::all();
        return response()->json($taskStatuses);
    }
}
