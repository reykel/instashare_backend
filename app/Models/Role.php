<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'scopes'
    ];

    public function scopes(){
        return $this->hasMany(Role::class, 'id');
    }
}
