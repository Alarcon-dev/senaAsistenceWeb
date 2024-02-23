<?php

namespace App\Http\Controllers;

use App\Models\parametro;
use App\Http\Requests\StoreparametroRequest;
use App\Http\Requests\UpdateparametroRequest;
use Illuminate\Http\Request;


class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('temas_parametros.parametros');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreparametroRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(parametro $parametro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(parametro $parametro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateparametroRequest $request, parametro $parametro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(parametro $parametro)
    {
        //
    }
    public function crearParametro(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            // ... otras validaciones
        ]);

        // Puedes obtener el ID del usuario actualmente autenticado
        $data['user_create_id'] = auth()->id();

        // Crear el parámetro
        $parametro = Parametro::create($data);

        // ... realizar otras acciones o redirigir según sea necesario

        return redirect()->back()->with('success', '¡Parámetro creado exitosamente!');
    }
}
