<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Tbl_master_plans;

class MasterplanController extends Controller
{

   public function master_plans(){
      $plans=DB::table('tbl_master_plans')->orderby('tbl_master_plans.id','desc')->get();
      return view('admin.master_plans',compact('plans'));
     }
     public function masterplaninsert(Request $request)
     {
      $validatedData = $request->validate([
          'master_plan_name' => 'required',            
       
  
      ]);
      
         $plans = new Tbl_master_plans;
         $plans->name= $request->master_plan_name;
         $plans->save();
         return redirect('master_plans')->with('success','Master Plan Added Successfully');
     }
     public function masterplansfetch(Request $request){
      $id=$request->id;
      $plans=Tbl_master_plans::find($id);
      print_r(json_encode($plans));
     }
     public function masterplansedit(Request $request)
     {
      $validatedData = $request->validate([
        'master_plan_name' => 'required',            
          
  
      ]);
         
         $id=$request->id;
         $plans=Tbl_master_plans::find($id);
         $plans->name= $request->master_plan_name;
         $plans->save();
         return redirect('master_plans')->with('success','Master Plan Edited Successfully');
  
     }
}
