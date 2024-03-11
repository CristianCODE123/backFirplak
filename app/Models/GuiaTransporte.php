<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuiaTransporte extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'GuiasTransporte';
    protected $primaryKey = 'GuiaTransporteID';
    protected $fillable = [
        'TransportadoraID',
        'FechaDespacho',
        'Destino',
        'ClienteID'
    ];

    public function entregas()
    {
        return $this->hasMany(Entrega::class, 'GuiaTransporteID');
    }

    public function transportadora()
    {
        return $this->belongsTo(Transportadora::class, 'TransportadoraID');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ClienteID');
    }
}
