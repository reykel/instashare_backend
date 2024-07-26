<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterByUser;

class File extends Model
{
    use HasFactory, FilterByUser;

    protected $fillable = ['name', 'path', 'document_type'];
}
