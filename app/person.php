<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class person extends Model
{
    //table name
    protected $table = 'person';
    //attributes
    protected $primaryKey = 'id';
    
    public $timestamps = true;

    //relationship's
    public function products(){
        return $this->belongsToMany('App\product',"personProduct","idPerson","idProduct");
    }
}
