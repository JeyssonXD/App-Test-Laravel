<?php

namespace App\ViewModel\typeProduct;

class ViewIndex {

  #region atribbutes
    public $name;
  #endregion

  #region methods
  public function isValid(){
    $flag=false;
    
    if(isset($this->name)){
      $flag=true;
    }
    
    return $flag;
  }
  #endregion

  
}