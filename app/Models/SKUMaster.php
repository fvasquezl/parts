<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKUMaster extends Model
{
    use HasFactory;
    protected $table = 'prt.RefSKUsMaster';
    protected $primaryKey = 'ref_sku';
    protected $guarded = [];
}
