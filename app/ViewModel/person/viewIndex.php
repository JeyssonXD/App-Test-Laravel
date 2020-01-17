<?php

namespace App\ViewModel\Person;

class ViewIndex {

  #region atribbutes
    public $name;
    public $products;
  #endregion

  #region methods
  public function isValid(){
    $flag=false;
    
    if(isset($this->name)){
      $flag=true;
    }
    
    if(isset($this->products) ){
      $flag=true;
    }

    return $flag;
  }
  #endregion

  
}