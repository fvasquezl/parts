<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;
    protected $table = 'prt.vw_VerifiedPartReferences';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
