<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuiaTransporte;

class guiasTransporte extends Controller
{
     public function store(Request $request)
    {
        $guiaTransporte = new GuiaTransporte();
        $guiaTransporte->TransportadoraID = $request->input('TransportadoraID');
        $guiaTransporte->Destino = $request->input('Destino');
        $guiaTransporte->ClienteID = $request->input('ClienteID');
        $guiaTransporte->save();

        return response()->json(['message' => 'Guía de transporte creada correctamente'], 201);
    }

    public function index()
    {
        $guiasTransporte = GuiaTransporte::all();
        return response()->json($guiasTransporte);
    }
}
