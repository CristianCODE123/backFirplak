<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\LineaPedido;
use App\Models\DocumentosEntrega;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
   


    public function store(Request $request)
    {
        $pedido = new Pedido();
        $pedido->FechaPedido = $request->input('fechaPedido');
        $pedido->Cliente = $request->input('Cliente');
        $pedido->FechaDespacho = $request->input('fechaDespacho');
        $pedido->FechaEntrega = $request->input('fechaEntrega');
        $pedido->EstadoPedido = "Pendiente";
        $pedido->clienteId = $request->input('ClienteId');
        $pedido->save();
    
        // Obtener el ID del pedido recién creado
        $pedidoId = $pedido->PedidoID;
        
        return response()->json(['message' => 'Pedido creado exitosamente', 'pedido_id' => $pedidoId], 201);
    }

  

    public function crearLineaPedido(Request $request, $pedidoId)
    {
        // Decodificar los datos enviados desde Angular
        $data = json_decode($request->getContent(), true);
    
        // Crear las líneas de pedido para cada elemento enviado desde Angular
        foreach ($data as $item) {
            $lineaPedido = new LineaPedido();
            $lineaPedido->PedidoID = $pedidoId;
            $lineaPedido->ProductoID = $item['ProductoID'];
            $lineaPedido->Cantidad = $item['CantidadProducto'];
            $lineaPedido->FechaEntrega = $item['fechaEntrega']; // Ajusta según tu necesidad
            $lineaPedido->TipoLinea = $item['Tipolinea'];
    
            // Determinar el estado de la línea según el tipo
            if ($item['Tipolinea'] == 'MTS') {
                $lineaPedido->EstadoLinea = 'Reserva';
            } elseif ($item['Tipolinea'] == 'MTO') {
                $lineaPedido->EstadoLinea = 'Fabricar';
            } else {
                // Asignar un valor por defecto o manejar el caso no especificado
                $lineaPedido->EstadoLinea = 'indefinido';
            }
    
            // Otros campos de la línea de pedido si es necesario
            $lineaPedido->save();
        }
        DB::statement('CALL InsertarDocumentoEntrega(?)', [$pedidoId]);
        return response()->json(['message' => 'Pedido creado correctamente'], 201);
    }

    public function consultarPedidosConLineas()
{
    // Ejecutar el procedimiento almacenado y obtener los resultados
    $resultados = DB::select('CALL ConsultarPedidosConLineas()');

    // Retornar los resultados como JSON
    return response()->json($resultados, 200);
}


public function obtenerDocumentosEntregaPorPedido($pedidoId)
{

    
    // Llamar al procedimiento almacenado
    $resultados = DB::select('CALL ObtenerDocumentosEntregaPorPedido(?)', [$pedidoId]);

    // Retorna los resultados obtenidos
    return $resultados;
}

public function obtenerDocumentosEntrega(Request $request)
{
    $pedidoId = $request->input('pedidoId');

    $documentosEntrega = $this->obtenerDocumentosEntregaPorPedido($pedidoId);

    return response()->json($documentosEntrega);
}


// En el controlador
public function subirFotoDocumento(Request $request, $documentoId)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('documentos', $fileName);

        // Guardar la ruta del archivo en la base de datos para el documento con ID $documentoId
        $documento = DocumentosEntrega::find($documentoId);
        $documento->Foto_Documento = $filePath;
        $documento->save();

        return response()->json(['message' => 'Archivo subido exitosamente'], 200);
    }

    return response()->json(['error' => 'No se ha proporcionado ningún archivo'], 400);
}

public function index()
{
    $pedido = Pedido::all();
    return response()->json($pedido);
}


public function indexLinea($pedidoId){
    // Filtrar las líneas de pedido por PedidoID específico
    $lineasPedido = LineaPedido::where('PedidoID', $pedidoId)->get();
    
    return response()->json($lineasPedido);
}


}
