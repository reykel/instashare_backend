<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'titular',
        'domicilio_legal',
        'denominacion_establecimiento',
        'direccion_establecimiento',
        'telefono_contacto',
        'email_contacto',
        'carnet_identidad_nit_one'
    ];


    public function getIsActiveAttribute($value){
        return $value == 0 ? 'Active' : 'Inactive';
    }
}
