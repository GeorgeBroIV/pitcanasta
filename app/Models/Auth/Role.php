<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    /**
     * The Roles that belong to the permissions.
     */
//    public function permissions()
//    {
//        return $this
//            ->belongsToMany('App\Models\Auth\Permission')
//            ->using('App\Models\Auth\PermissionRole')
//            ->withPivot([
//                'created_by',
//                'updated_by',
//            ]);
//    }
    
    /**
     * The Roles that belong to the permissions.
     */
    public function users()
    {
        return $this
            ->belongsToMany('App\Models\Auth\User')
            ->using('App\Models\Auth\RoleUser')
            ->withPivot([
                'created_by',
                'updated_by',
            ]);
    }
}
