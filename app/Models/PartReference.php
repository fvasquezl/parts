<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartReference extends Model
{
    use HasFactory;

    protected $table = 'prt.PartReferences';
    protected $primaryKey = 'PartID';
    public $timestamps = false;
    protected $guarded = [];
}
