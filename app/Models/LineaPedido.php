<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
    use HasFactory;

    protected $table = 'LineasPedido';
    protected $primaryKey = 'LineaID';
    public $timestamps = false;

    protected $fillable = [
        'PedidoID',
        'ProductoID',
        'Cantidad',
        'FechaEntrega',
        'TipoLinea',
        'EstadoLinea',
        'EstadoTransporteID'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'PedidoID');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ProductoID');
    }
    
}
