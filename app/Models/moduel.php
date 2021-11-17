<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class moduel extends Model
{
    use HasFactory;
    protected  $table = 'module';
    protected $fillable = ['module', 'moduleId'];
    protected $primaryKey = 'id';

    public function FinancialTrans()
    {
        return $this->hasOne(FinancialTrans::class, 'id');
    }

    public function FinancialTransDetails()
    {
        return $this->hasOne(FinancialTransDetails::class, 'id');
    }

}
