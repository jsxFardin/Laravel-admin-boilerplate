<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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



    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        if (is_array($roles) || is_object($roles)) {
            return !!$roles->intersect($this->roles)->count();
        }
        return $this->roles->contains('name', $roles);
    }

    public function isAdmin()
    {
        foreach ($this->roles as $role) {
            if (in_array($role->id, [0,1])) {
                return true;
            }
        }
        return false;
    }

    public function employeeDetail()
    {
        return $this->hasOne(EmployeeDetail::class);
    }



    protected function getBranchNameAttribute()
    {
        return
            $this->employeeDetail()->first() && $this->employeeDetail()->first()->branch()->first() ?
            $this->employeeDetail()->first()->branch()->first()->name : null;
    }

    protected function getDepartmentNameAttribute()
    {
        return
            $this->employeeDetail()->first() && $this->employeeDetail()->first()->department()->first() ?
            $this->employeeDetail()->first()->department()->first()->name : null;
    }

    protected function getDesignationNameAttribute()
    {
        return
            $this->employeeDetail()->first() && $this->employeeDetail()->first()->designation()->first() ?
            $this->employeeDetail()->first()->designation()->first()->name : null;
    }

    protected function getJoiningDateAttribute()
    {
        return $this->employeeDetail()->first() ?
            Carbon::parse($this->employeeDetail()->first()->joining_date)->format('d F Y') : null;
    }

    protected function getSupervisorAttribute()
    {
        return $this->employeeDetail()->first() && $this->employeeDetail()->first()->supervisor() ?
            $this->employeeDetail()->first()->supervisor()->first() : null;
    }

    protected function getAccommodationAttribute()
    {
        return $this->employeeDetail()->first() ?
            $this->employeeDetail()->first()->accommodation_cost : null;
    }

    protected function getDailyAllowanceAttribute()
    {
        return $this->employeeDetail()->first() ?
            $this->employeeDetail()->first()->daily_allowance_cost : null;
    }

    protected function getRoleIdAttribute()
    {
        return $this->roles() ?? null;
    }

}
