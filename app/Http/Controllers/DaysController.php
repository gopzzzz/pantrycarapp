<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class DaysController extends Controller
{
   public function daylist(){
    $daylist=DB::table('days')->get();
    return view('admin.daylist',compact('daylist'));
   }
   public function dayfetch(){
    
   }
}
