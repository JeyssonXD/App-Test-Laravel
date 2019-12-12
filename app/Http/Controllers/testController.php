<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;

class testController extends Controller
{
    //
    public function test(){
        $test = product::find(2);
        $brand = $test->typeProduct()->get();
        return $brand;
    }
}
