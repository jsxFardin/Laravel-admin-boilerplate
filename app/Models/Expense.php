<?php

namespace App\Models;

use Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $fillable = [
        'expense_type_id', 'destination_id', 'duration_to', 'duration_form', 'amount', 'status', 'created_by', 'created_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'duration_to', 'duration_form', 'created_at'
    ];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }



    protected function getDurationToAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d g:i A');
    }

    protected function getDurationToDateAttribute()
    {
        return Carbon::parse($this->duration_to)->format('d F Y g:i A');
    }

    protected function getDurationFormAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d g:i A');
    }

    protected function getDurationFormDateAttribute()
    {
        return Carbon::parse($this->duration_form)->format('d F Y g:i A');
    }

    protected function getExpenseNameAttribute()
    {
        return $this->expenseType()->first()->name ?? null;
    }

    protected function getDestinationToAttribute()
    {
        return
            ucfirst($this->destination()->first()->travel_to()->first()->name) ?? null;
    }

    protected function getDestinationFromAttribute()
    {
        return
            ucfirst($this->destination()->first()->travel_from()->first()->name) ?? null;
    }

    protected function getUserAttribute()
    {
        return ucfirst($this->user()->first()->name) ?? null;
    }
}
