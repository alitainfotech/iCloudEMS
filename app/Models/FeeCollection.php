<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCollection extends Model
{
    use HasFactory;
    protected $table = 'common_fee_collection';
    protected $primaryKey = 'id';
}
