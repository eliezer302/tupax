<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User as UserModel;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserModel::all();
        return response()->json($users);
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
            'name'     => ['required'],
            'email'    => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
        ],[
            'name.required'     => 'Nombre es requerido.',
            'email.required'    => 'Email es requerido.',
            'email.email'       => 'Email es incorrecto.',
            'email.unique'      => 'Email ya existe.',
            'password.required' => 'Contraseña es requerida.',
            'password.min'      => 'Contraseña debe tener mínimo 8 carácteres.'
        ]);

        if ($validatedData->fails()):
            $result['message'] = $validatedData->errors();
            return response()->json($result, 400);
        endif;

        $newUser = UserModel::create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        if($newUser) {
            $result['error']   = 0;
            $result['message'] = 'Usuario creado exitosamente';
        } else {
            $result['message'] = 'Usuario no pudo ser creado';
        }
        
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $user = UserModel::where('email', $email)
            ->with('tasks')
            ->first();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        $result = [
            'error'   => 1,
            'message' => 'No se inició el proceso'
        ];

        $user = UserModel::where('email', $email)->first();

        if(!$user):
            $result['message'] = 'El usuario no fue encontrado';
            return response()->json($result, 404);
        endif;

        $user->name     = $request['name'] ? $request['name'] : $user->name;
        $user->password = $request['password'] ? Hash::make($request['password']) : $user->password;

        if(!$user->save()):
            $result['message'] = 'El usuario no pudo ser actualizado';
            return response()->json($result);
        endif;

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
