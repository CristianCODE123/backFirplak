<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    use HasFactory;

    protected $table = 'Productos';
    protected $primaryKey = 'ProductoID';
    public $timestamps = false;

    protected $fillable = [
        'NombreProducto',
        'Precio',
        'Descripcion',
    ];
}
