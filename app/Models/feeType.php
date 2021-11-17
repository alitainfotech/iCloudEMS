<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feeType extends Model
{
    use HasFactory;
    protected $fillable = ['fee_id', 'f_name', 'collection_id', 'br_id', 'seq_id', 'fee_type_ledger', 'fee_headtuy'];
    protected $table = 'fee_types';
    protected $primaryKey = 'id';

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id');
    }

    public function feecollection()
    {
        return $this->belongsTo(feeCollectionType::class, 'id');
    }
}
