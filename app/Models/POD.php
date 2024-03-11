<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POD extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'PODs';
    protected $primaryKey = 'POD_ID';
    protected $fillable = [
        'GuiaTransporteID',
        'Foto_POD',
        'Observaciones',
        'fotoDocumentosTansporte'
    ];

    public function guiaTransporte()
    {
        return $this->belongsTo(GuiaTransporte::class, 'GuiaTransporteID');
    }
}
