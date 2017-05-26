<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     *The attributes that is used to define table name for this model.
     */
    protected $table = "roles";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     *The users that have to roles.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_roles', 'role_id', 'user_id');
    }

    /**
     *The permissions that belongs to role.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permissions', 'roles_permissions', 'role_id', 'permission_id');
    }

    public function hasPermissionRole($name)
    {
        foreach ($this->permissions as $permission) {
            if ($permission->name == $name) return true;
        }

        return false;
    }

    /**
     * This method is used to fetch roles
     */
    public function fetchRoles($columnArray = '*')
    {
        $roles = Roles::all($columnArray);
        return $roles;
    }

}
