<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'Pedidos';

    protected $primaryKey = 'PedidoID';

    protected $fillable = [
        'FechaPedido',
        'Cliente',
        'FechaDespacho',
        'FechaEntrega',
        'EstadoPedido',
        'clienteId',
        'EstadoTransporteID'
    ];

    public $timestamps = false;

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clienteId');
    }
    
    public function EstadoTransporte()
    {
        return $this->belongsTo(Cliente::class, 'EstadoTransporteID');
    }
}
