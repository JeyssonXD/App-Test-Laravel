<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typeProduct extends Model
{
    //
    //table name
    protected $table = 'product';
    //attributes
    protected $primaryKey = 'id';
    
    public $timestamps = true;

    //relationship
    public function product()
    {
        return $this->belongsTo('App\product','idTypeProduct');
    }
}
