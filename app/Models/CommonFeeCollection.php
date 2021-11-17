<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonFeeCollection extends Model
{
    use HasFactory;
    protected $fillable = ['module_id', 'trans_id', 'admno', 'rollno', 'amount', 'br_id', 'acadamicYear', 'financialYear', 'displayReceiptNo', 'Entrymode'];
    protected $table = 'common_fee_collection';
    protected $primaryKey = 'id';
}
