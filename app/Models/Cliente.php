<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $table = 'Clientes'; // Especifica el nombre de la tabla

    protected $primaryKey = 'ClienteID'; // Especifica la clave primaria

    public $incrementing = true; // Habilita o deshabilita la auto-incrementación del ID

    protected $fillable = [
        'NombreCliente', 'DireccionCliente', 'CorreoElectronico'
    ];

}
