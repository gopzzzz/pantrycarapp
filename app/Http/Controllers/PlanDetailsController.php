<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Plan_details;

class PlanDetailsController extends Controller
{
   public function plandetails(){
    $plandetails=DB::table('plan_details')->orderby('plan_details.id','desc')->get();
    return view('admin.plandetails',compact('plandetails'));
   }
   public function plandetailsinsert(Request $request)
   {
    $validatedData = $request->validate([
        'plan_name' => 'required',            
        'description' => 'required',
        'breakfast' => 'required',
        'lunch' => 'required',
        'dinner' => 'required',

    ]);
    
       $plandetails = new Plan_details;
       $plandetails->name = $request->plan_name;
       $plandetails->description = $request->description;
       $plandetails->breakfast= $request->breakfast;
       $plandetails->lunch= $request->lunch; 
       $plandetails->dinner = $request->dinner;
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

    ]);
       
       $id=$request->id;
       $plandetails=Plan_details::find($id);
       $plandetails->name = $request->plan_name;
       $plandetails->description = $request->description;
       $plandetails->breakfast= $request->breakfast;
       $plandetails->lunch= $request->lunch; 
       $plandetails->dinner = $request->dinner;
       $plandetails->save();
       return redirect('plandetails')->with('success','Plan Details Edited Successfully');

   }
}
