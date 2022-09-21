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



    public function shelf()
    {
        return $this->belongsTo(Shelf::class,'shelf_id','shelf_id');
    }

    public function getDateCreated() {
        if($this->date_created){
            return $this->date_created->format('m/d/Y');
        }
    }

    public function getIsActive() {
        return $this->is_active ? 'yes': 'no';
//        if($this->is_active){
//            return true;
//        }else{
//
//        }
    }

}
