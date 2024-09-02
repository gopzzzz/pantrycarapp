<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Days;

class DaysController extends Controller
{
   public function daylist(){
    $daylist=DB::table('days')->get();
    return view('admin.daylist',compact('daylist'));
   }
   public function day(){
      $days=DB::table('days')->orderby('days.id','asc')->get();
      return view('admin.day',compact('days'));
     }
     public function daysinsert(Request $request)
     {
      $validatedData = $request->validate([
          'day_name' => 'required',            
       
  
      ]);
      
         $days = new Days;
         $days->day = $request->day_name;
         $days->save();
         return redirect('day')->with('success','Day Added Successfully');
     }
     public function daysfetch(Request $request){
      $id=$request->id;
      $days=Days::find($id);
      print_r(json_encode($days));
     }
     public function daysedit(Request $request)
     {
      $validatedData = $request->validate([
          'day_name' => 'required',            
          
  
      ]);
         
         $id=$request->id;
         $days=Days::find($id);
         $days->day = $request->day_name;
         $days->save();
         return redirect('day')->with('success','Day Edited Successfully');
  
     }
}
