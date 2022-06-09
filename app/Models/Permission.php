<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'permission_group_id'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }

    public function permissionGroups()
    {
        return $this->belongsToMany(PermissionGroup::class, 'permission_group_permission');
    }
}
