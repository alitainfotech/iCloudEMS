<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feeCategory extends Model
{
    use HasFactory;
    protected $table = 'fee_category';
    protected $fillable = [
        'feeCategory', 'br_id'
    ];
    protected $primaryKey = 'id';

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id');
    }
}
