<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class errorController extends Controller
{
    /**401*/
    public function UnAuthorize()
    {
        //
        return view("error/UnAuthorize");
    }
}
