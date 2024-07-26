<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

$morphPrefix = config('audit.user.morph_prefix', 'user');

class Auditorias extends Model
{
    use HasFactory;

    protected $table = "audits";

    protected $fillable = [
        'user_type',
        'user_id',
        'event',
        'auditable',
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent',
        'tags'
    ];
}
