<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task as TaskModel;
use App\Models\User as UserModel;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = TaskModel::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = [
            'error'   => 1,
            'message' => 'No se inició el proceso'
        ];

        $validatedData = \Validator::make($request->all(), [
            'name'        => ['required'],
            'email'       => ['required', 'email'],
            'description' => ['required']
        ],[
            'name.required'        => 'Nombre es requerido.',
            'email.required'       => 'Email es requerido.',
            'email.email'          => 'Email es incorrecto.',
            'email.unique'         => 'Email ya existe.',
            'description.required' => 'Descripción es requerida.'
        ]);

        if ($validatedData->fails()):
            $result['message'] = $validatedData->errors();
            return response()->json($result, 400);
        endif;

        $user = UserModel::select('id')
            ->where('email', $request['email'])
            ->first();

        if(empty($user)):
            $result['message'] = 'El usuario con el email: ' . $request['email'] . ' no fue encontrado';
            return response()->json($result, 404);
        endif;

        $newTask = TaskModel::create([
            'name'           => $request['name'],
            'description'    => $request['description'],
            'user_id'        => $user->id,
            'task_status_id' => 1
        ]);

        if($newTask):
            $result['error']   = 0;
            $result['message'] = 'Tarea creada exitosamente';
        else:
            $result['message'] = 'La tarea creada no pudo ser creada';
        endif;
        
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = TaskModel::where('id', $id)
            ->with('user', 'taskStatus')
            ->first();
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = [
            'error'   => 1,
            'message' => 'No se inició el proceso'
        ];

        $task = TaskModel::find($id);

        if(!$task):
            $result['message'] = 'La tarea no fue encontrada';
            return response()->json($result, 404);
        endif;

        $task->name           = $request->input('name') ? $request->input('name') : $task->name;
        $task->description    = $request->input('description') ? $request->input('description') : $task->description;
        $task->task_status_id = $request->input('task_status_id') ? $request->input('task_status_id') : $task->task_status_id;

        if(!$task->save()):
            $result['message'] = 'La tarea no pudo ser actualizada';
            return response()->json($result);
        endif;

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks = TaskModel::destroy($id);
        return response()->json('Tarea ' . $id  . ' eliminada exitosamente');
    }
}
