<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'succeded',
        'ip_address',
        'user_agent',
        'organization_id'
    ];
}
