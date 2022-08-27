<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $table = 'bin.Boxes';
    protected $primaryKey = 'box_id';
//    public $timestamps = false;
    protected $guarded = [];
    protected $dates = ['date_created'];


    public function getDateCreated() {
        if($this->date_created){
            return $this->date_created->format('m/d/Y');
        }
    }

}
