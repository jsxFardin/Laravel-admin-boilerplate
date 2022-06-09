<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function expense_details()
    {
        return $this->hasMany(ExpenseDetail::class);
    }

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
}
