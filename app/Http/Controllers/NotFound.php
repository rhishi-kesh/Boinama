<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotFound extends Controller
{
    public function notfound(){
        return view("notfound");
    }
}
