<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Traits\AccountStatus;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, AccountStatus;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'organization_id',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function organizations(){
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function getIsActiveAttribute($value){
        return $value == 0 ? 'Active' : 'Inactive';
    }

    public function scopes(){
        return $this->hasOne(Scope::class, 'user_id');
    }
}
