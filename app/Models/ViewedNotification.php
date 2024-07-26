<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewedNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_id',
        'user_id'
    ];

    public function notifications(){
        return $this->belongsTo(Notification::class, 'notification_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
