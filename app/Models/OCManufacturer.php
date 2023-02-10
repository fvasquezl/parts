<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OCManufacturer extends Model
{
    use HasFactory;

    protected $table = 'oc.OC_Manufacturers';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
