<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterByUser;
use OwenIt\Auditing\Contracts\Auditable;

class Producto extends Model implements Auditable
{
    use HasFactory, FilterByUser, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'descripcion',
        'precio',
        'um',
        'categoria_id',
        'organization_id'
    ];

    public function categorias(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
