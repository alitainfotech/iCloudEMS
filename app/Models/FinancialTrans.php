<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTrans extends Model
{
    use HasFactory;
    protected $fillable = ['module_id', 'tran_id', 'amount', 'tranDate', 'acadYear', 'entrymode', 'Voucherno', 'br_id', 'due_amount', 'scholarship', 'duerev', 'scholarship_rev'];
    protected $table = 'financial_trans';
    protected $primaryKey = 'id';

    public function module()
    {
        return $this->belongsTo(moduel::class, 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id');
    }
}
