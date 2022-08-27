<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelve extends Model
{
    use HasFactory;
    protected $table = 'bin.Shelves';
    protected $primaryKey = 'shelf_id';
//    public $timestamps = false;
    protected $guarded = [];
 protected $dates = ['DateCreated'];


    public function getCreatedAt() {
        if($this->created_at){
            return $this->created_at->format('m/d/Y');
        }
    }
}
