<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosEntrega extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'DocumentosEntrega';
    protected $primaryKey = 'DocumentoEntregaID';
    protected $fillable = [
        'EntregaID',
        'Foto_Documento',
        'EstadoDocumentoEntrega'
    ];

    public function entrega()
    {
        return $this->belongsTo(Entrega::class, 'EntregaID');
    }
}
