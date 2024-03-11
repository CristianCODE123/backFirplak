<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\POD;
use App\Models\GuiaTransporte;
use App\Models\DocumentoEntrega;


class TransporteController extends Controller
{
    public function almacenarDatos(Request $request)
    {
        // Validar datos
        $request->validate([
            // Aquí coloca las reglas de validación según tus necesidades
        ]);

        // Insertar datos en la base de datos
        $pod = POD::create($request->input('pod'));
        $guiaTransporte = GuiaTransporte::create($request->input('guiaTransporte'));
        $documentoEntrega = DocumentoEntrega::create($request->input('documentoEntrega'));

        // Devolver respuesta
        return response()->json(['message' => 'Datos almacenados correctamente'], 200);
    }
}
