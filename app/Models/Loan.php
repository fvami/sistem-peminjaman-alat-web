<?php

namespace App\Models;

use App\Models\User;
use App\Models\LoanDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'borrower_name',
        'borrower_phone',
        'borrower_address',
        'status',
        'loan_date',
        'return_plan',
        'returned_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(LoanDetail::class);
    }
}
