<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feeCollectionType extends Model
{
    use HasFactory;
    protected $fillable = ['collectionhead', 'collectionDescription', 'br_id'];
    protected $table = 'fee_collection_type';
    protected $primaryKey = 'id';


    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id');
    }

    public function feeType()
    {
        return $this->hasOne(feeType::class, 'id');
    }
}
