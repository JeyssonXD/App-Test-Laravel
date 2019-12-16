<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typeProduct extends Model
{
    //
    //table name
    protected $table = 'typeProduct';
    //attributes
    protected $primaryKey = 'id';
    
    public $timestamps = true;

    //relationship
    public function product()
    {
        return $this->belongsTo("App\product","id","idTypeProduct");
    }
}
