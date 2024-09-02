<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Messb2csalesController extends Controller
{
    public function b2csales(){
        $sales=DB::table('b2c_sales')->orderby('b2c_sales.id','desc')->get();
        return view('admin.b2csales',compact('sales'));
    }
}
