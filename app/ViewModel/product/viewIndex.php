<?php

namespace App\ViewModel\Product;

class ViewIndex {

  #region atribbutes
    public $name;
    public $price;
    public $idTypeProduct;
  #endregion

  #region methods
  public function isValid(){
    $flag=false;
    
    if(isset($this->name)){
      $flag=true;
    }

    if(isset($this->price)){
      $flag=true;
    }

    if(isset($this->idTypeProduct)){
      $flag=true;
    }
    
    return $flag;
  }
  #endregion

  
}