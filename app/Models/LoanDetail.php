<?php

namespace App\Models;

use App\Models\Loan;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_id',
        'tool_id',
        'qty',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }
}
