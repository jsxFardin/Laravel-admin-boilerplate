<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'order_no',
        'icon',
        'url',
        'status',
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function parent()
    {
        return $this->belongsTo(PermissionGroup::class, 'parent_id');
    }
}
