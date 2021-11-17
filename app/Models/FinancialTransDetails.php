<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransDetails extends Model
{
    use HasFactory;
    protected $fillable = ['financialtran_id', 'module_id', 'amount', 'head_id', 'crdr', 'br_id', 'head_name'];
    protected $table = 'financial_transdetail';
    protected $primaryKey = 'id';

    public function branch()
    {
        return $this->belongsTo(branch::class, 'id');
    }

    public function module()
    {
        return $this->belongsTo(moduel::class, 'id');
    }
}
