<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

trait FilterByUser {

    protected static function boot(){
        parent::boot();

        self::creating(function($model){
            $model->organization_id = self::getOrganizationId(auth()->id());
        });

        self::addGlobalScope(function(Builder $builder){
            $builder->where('organization_id', self::getOrganizationId(auth()->id()));
        });
    }

    private static function getOrganizationId($id){
        $user = User::findOrFail($id);
        return $user->organization_id;
    }
}