<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Plan_details;

class PlanDetailsController extends Controller
{
   public function plandetails(){
    $plan=DB::table('tbl_master_plans')->get();
    $plandetails=DB::table('plan_details')
    ->leftjoin('tbl_master_plans', 'plan_details.masterplan_id', '=', 'tbl_master_plans.id')
    ->orderby('plan_details.id','desc')
    ->select('plan_details.*', 'tbl_master_plans.name as master_plan_name')
    ->get();
    return view('admin.plandetails',compact('plandetails','plan'));
   }
   public function plandetailsinsert(Request $request)
   {
    $validatedData = $request->validate([
        'plan_name' => 'required',            
        'description' => 'required',
        'breakfast' => 'required',
        'lunch' => 'required',
        'dinner' => 'required',
        'total_days' => 'required',


    ]);
    
       $plandetails = new Plan_details;
       $plandetails->masterplan_id= $request->plan_name;
       $plandetails->description = $request->description;
       $plandetails->breakfast= $request->breakfast;
       $plandetails->lunch= $request->lunch; 
       $plandetails->dinner = $request->dinner;
       $plandetails->total_days = $request->total_days;
       $plandetails->save();
       return redirect('plandetails')->with('success','Plan Details Added Successfully');
   }
   public function plandetailsfetch(Request $request){
    $id=$request->id;
    $plandetails=Plan_details::find($id);
    print_r(json_encode($plandetails));
   }
   public function plandetailsedit(Request $request)
   {
    $validatedData = $request->validate([
        'plan_name' => 'required',            
        'description' => 'required',
        'breakfast' => 'required',
        'lunch' => 'required',
        'dinner' => 'required',
        'total_days' => 'required',


    ]);
       
       $id=$request->id;
       $plandetails=Plan_details::find($id);
       $plandetails->masterplan_id= $request->plan_name;
       $plandetails->description = $request->description;
       $plandetails->breakfast= $request->breakfast;
       $plandetails->lunch= $request->lunch; 
       $plandetails->dinner = $request->dinner;
       $plandetails->total_days = $request->total_days;
       $plandetails->save();
       return redirect('plandetails')->with('success','Plan Details Edited Successfully');

   }
}
