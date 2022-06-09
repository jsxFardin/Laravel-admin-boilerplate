<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'travel_from_id', 'travel_to_id', 'amount', 'status'
    ];

    public function travel_from()
    {
        return $this->belongsTo(Location::class, 'travel_from_id');
    }

    public function travel_to()
    {
        return $this->belongsTo(Location::class, 'travel_to_id');
    }

    public function getTravelFromAttribute()
    {
        return ucfirst($this->travel_from()->first()->name) ?? null;
    }

    public function getTravelToAttribute()
    {
        return ucfirst($this->travel_to()->first()->name) ?? null;
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function scopeStatus($query)
    {
        return $query->where('status', '=', 1);
    }
}
