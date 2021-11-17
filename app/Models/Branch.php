<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'branch';
    protected $fillable = ['name'];
    protected $primaryKey = 'id';


    public function feeCollectionType()
    {
        return $this->hasOne(feeCollectionType::class, 'id');
    }

    public function feeCategory()
    {
        return $this->hasOne(feeCategory::class, 'id');
    }

    public function feeType()
    {
        return $this->hasOne(feeType::class, 'id');
    }

    public function FinancialTrans()
    {
        return $this->hasOne(FinancialTrans::class,'id');
    }

    public function FinancialTransDetails()
    {
        return $this->hasOne(FinancialTransDetails::class,'id');
    }
}
