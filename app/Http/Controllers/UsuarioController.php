<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $usuarios=User::all();
        $isAdmin = Auth::user()->isAdmin(); // Verifica si el usuario actual es un administrador
        return view('usuario.index')->with('usuarios',$usuarios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $name = $request->get('name');
    $apePat = $request->get('apePat');
    $apeMat = $request->get('apeMat');
    $tipo = $request->get('tipo');
    $email = $request->get('email');
    $password = $request->get('password');
    $password1 = $request->get('password1');

    if (empty($name) || empty($apePat) || empty($apeMat) || empty($tipo) || empty($email) || empty($password) || empty($password1)) {
        $error_message = 'Por favor, completa todos los campos';
        return redirect('/usuarios/create')->with('error', $error_message);
    }

    if ($password !== $password1) {
        $error_message = 'Las contraseñas no coinciden';
        return redirect('/usuarios/create')->with('error', $error_message);
    }

    $usuarios = new User();
    $usuarios->name = $name;
    $usuarios->apePat = $apePat;
    $usuarios->apeMat = $apeMat;
    $usuarios->tipo = $tipo;
    $usuarios->email = $email;
    $usuarios->password = bcrypt($password);
    $usuarios->save();

    return redirect('/usuarios');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario=User::find($id);
        return view('usuario.edit')->with('usuario',$usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::find($id);
        $usuario->name = $request->get('name');
        $usuario->apePat = $request->get('apePat');
        $usuario->apeMat = $request->get('apeMat');
        $usuario->tipo = $request->get('tipo');
        $usuario->email = $request->get('email');
        $password = $request->get('password');
        $password1 = $request->get('password1');

        if ($password !== $password1) {
            $error_message = 'Las contraseñas no coinciden';
            return redirect("/usuarios/{$id}/edit")->with('error', $error_message);
        }

        if (empty($password) && empty($password1)) {
            $error_message = 'Los campos de contraseña y confirmación de contraseña no pueden estar vacíos';
            return redirect("/usuarios/{$id}/edit")->with('error', $error_message);
        }

        $usuario->password = bcrypt($password);
        $usuario->save();

        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario=User::find($id);
        $usuario->delete();
        return redirect('/usuarios');
    }
}
