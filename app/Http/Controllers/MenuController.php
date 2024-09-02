<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MenuController extends Controller
{
   public function menu(){
    $plans=DB::table('tbl_master_plans')->get();
    $days=DB::table('days')->get();
    return view('admin.menulist',compact('plans','days'));
   }
}
