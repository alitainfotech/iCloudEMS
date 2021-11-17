<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonFeeCollectionHeadwise extends Model
{
    use HasFactory;
    protected $fillable = ['module_id', 'receipt_id', 'head_id', 'headName', 'br_id', 'amount'];
    protected $table = 'common_fee_collection_headwise';
    protected $primaryKey = 'id';
}
