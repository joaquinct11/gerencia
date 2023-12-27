<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Auth;


class IncidenciaController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    public function index()
    {
        $incidencias=Incidencia::all();
        return view('incidencia.index')->with('incidencias',$incidencias);
    }

    public function principal()
    {
        $incidencias = Incidencia::all(); // Asegúrate de usar el nombre correcto del modelo

        return view('incidencia.principal', compact('incidencias'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('incidencia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $userId = Auth::id(); // Obtiene el ID del usuario autenticado

    $tipoInci = $request->get('tipoInci');
    $descInci = $request->get('descInci');
    $fechRegiInci = $request->get('fechRegiInci');

    if (empty($tipoInci) || empty($descInci) || empty($fechRegiInci)) {
        $error_message = 'Por favor, completa todos los campos';
        return redirect('/incidencias/create')->with('error', $error_message);
    }

    if ($userId) {
        $incidencias = new Incidencia();
        $incidencias->codigoUsu = $userId;
        $incidencias->tipoInci = $tipoInci;
        $incidencias->descInci = $descInci;
        $incidencias->fechRegiInci = $fechRegiInci;
        $incidencias->soluInci = '-';
        $incidencias->estaInci = 'Registrado'; // Cambia esto a un valor predeterminado válido
        $incidencias->save();
        return redirect('/incidencias');
    } else {
        // Lógica en caso de que no se encuentre el usuario
    }
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
        $incidencia=Incidencia::find($id);
        return view('incidencia.edit')->with('incidencia',$incidencia);
    }
    
    public function solucionar(string $id)
    {
        $incidencia=Incidencia::find($id);
        return view('incidencia.solucionar')->with('incidencia',$incidencia);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $userId = Auth::id(); // Obtiene el ID del usuario autenticado

    $soluInci = $request->get('soluInci');
    $fechSoluInci = $request->get('fechSoluInci');

    if (empty($soluInci) || empty($fechSoluInci)) {
        $error_message = 'Por favor, completa todos los campos';
        return redirect("/incidencias/{$id}/edit")->with('error', $error_message);
    }

    if ($userId) {
        $incidencia = Incidencia::find($id);
        $incidencia->codigoUsu = $request->get('codigoUsu');
        $incidencia->tipoInci = $request->get('tipoInci');
        $incidencia->descInci = $request->get('descInci');
        $incidencia->fechRegiInci = $request->get('fechRegiInci');
        $incidencia->soluInci = $soluInci;
        $incidencia->fechSoluInci = $fechSoluInci;
        $incidencia->estaInci = 'Atendido'; // Cambia esto a un valor predeterminado válido
        $incidencia->save();
        return redirect('/incidencias');
    } else {
        // Lógica en caso de que no se encuentre el usuario
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $incidencia=Incidencia::find($id);
        $incidencia->delete();
        return redirect('/incidencias');
    }
}
