<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    //table name
    protected $table = 'product';
    //attributes
    protected $primaryKey = 'id';
    
    public $timestamps = true;

    //relationship's
    public function typeProduct(){
        return $this->hasMany('App\typeProduct',"id","idTypeProduct");
    }

    public function persons(){
        return $this->belongsToMany('App\person',"personProduct","idProduct","idPerson");
    }
}
