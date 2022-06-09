<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_id', 'type_of_expense', 'description', 'cost'
    ];

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

}
