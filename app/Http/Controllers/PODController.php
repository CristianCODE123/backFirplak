<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\POD; // Asegúrate de importar el modelo POD

class PODController extends Controller
{

    public function index()
    {
        $productos = POD::all();
        return response()->json($productos);
    }

    public function store(Request $request)
    {
        // Procesar y guardar las imágenes
        $pod = new POD;
        $pod->GuiaTransporteID = $request->GuiaTransporteID;
        $pod->Observaciones = $request->Observaciones;

        // Guardar la primera imagen
        $image1 = $request->file('Foto_POD');
        $imagePath1 = $image1->store('public/images'); // Ajusta la ruta de almacenamiento según tus necesidades
        $pod->Foto_POD = $imagePath1;

        // Guardar la segunda imagen
        $image2 = $request->file('fotoDocumentosTansporte');
        $imagePath2 = $image2->store('public/images'); // Ajusta la ruta de almacenamiento según tus necesidades
        $pod->fotoDocumentosTansporte = $imagePath2;

        $pod->save();

        return response()->json(['message' => 'POD creado correctamente'], 201);
    }
    
}
