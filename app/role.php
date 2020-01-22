<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    //table name
    protected $table = 'role';
    //attributes
    protected $primaryKey = 'id';
    
    public $timestamps = true;

    //relationship's
    public function users(){
        return $this->belongsToMany('App\user',"userRole","idRole","idUser");
    }
}
