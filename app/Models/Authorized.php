<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterByUser;

class Authorized extends Model
{
    use HasFactory, FilterByUser;

    protected $fillable = [
        'name',
        'carnet_identidad',
        'organization_id'
    ];
}
