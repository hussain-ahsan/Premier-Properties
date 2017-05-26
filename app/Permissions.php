<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    /**
     *The attributes that is used to define table name for this model.
     */
    protected $table = "permissions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     *The roles that have permissions.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Roles', 'roles_permissions', 'permission_id', 'role_id');
    }

}
