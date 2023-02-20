<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OCAccessories extends Model
{
    use HasFactory;

    protected $table = 'oc.OC_Accessories';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
