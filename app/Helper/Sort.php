<?php

namespace App\Helper;

 class Sort{

  //return next sort from previus
  public static function nextSort($field,$prevSort){
    $sortOrder = $field."_".$prevSort;
    if($prevSort==="ASC"){
      $sortOrder = $field."_DESC";
    }else if($prevSort==="DESC"){
      $sortOrder = $field."_ASC";
    }
    return $sortOrder;
  }


}