<?php

namespace App\Http\Controllers;

use App\Models\Donacion;
use Illuminate\Http\Request;
use App\Models\SolicitudDonacion;
use Illuminate\Support\Facades\DB;

class DonacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            //code...
            $donacion = new Donacion();
            $donacion->solicitud_id = $request->solicitud_id;
            $donacion->unidades = $request->unidades;
            $donacion->save();
        
            // Actualizar la campaña asociada, ejemplo básico
            $solicitud = SolicitudDonacion::find($request->solicitud_id);
            $campania = $solicitud->campania;
            $campania->unidades_donadas += $request->unidades;
            $campania->save();
            DB::commit();
            return response()->json(['success' => 'Donación registrada correctamente.']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'Donación no se pud registrar.'],500);
        }
        //
    
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}