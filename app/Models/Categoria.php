<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterByUser;
use OwenIt\Auditing\Contracts\Auditable;

class Categoria extends Model implements Auditable
{
    use HasFactory, FilterByUser, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'descripcion',
        'organization_id'
    ];

    public function productos(){
        return $this->hasMany(Producto::class, 'id');
    }
}
