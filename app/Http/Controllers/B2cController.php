<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\B2c_sales;

class B2cController extends Controller
{
   public function b2csales(){
    $plan=DB::table('plan_details')
    ->leftjoin('tbl_master_plans', 'plan_details.masterplan_id', '=', 'tbl_master_plans.id')
    ->select('plan_details.id','tbl_master_plans.name','plan_details.total_days')
    ->get();
    $customer=DB::table('customers')->get();
    $sales=DB::table('b2c_sales')
    ->leftjoin('tbl_master_plans', 'b2c_sales.plan_id', '=', 'tbl_master_plans.id')
    ->leftjoin('customers', 'b2c_sales.customer_id', '=', 'customers.id')
    ->orderby('b2c_sales.id','desc')
    ->select('b2c_sales.*', 'tbl_master_plans.name as master_plan_name', 'customers.name as customer_name')
    ->get();
    return view('admin.b2csales',compact('sales','plan','customer'));
   }
   public function b2csalesinsert(Request $request)
   {
    $validatedData = $request->validate([
        'plan_name' => 'required',            
        'customer_name' => 'required',
        'sale_date' => 'required',
        'sale_amount' => 'required',
        'tax_amount' => 'required',
        'total_amount' => 'required',
        'number_of_days' => 'required',
        



    ]);

    $invoice=DB::table('b2c_sales') ->orderBy('name', 'desc')->first();
    if($invoice){
        $invoiceID=$invoice->id+1;
    }else{
        $invoiceID=1;
    }
    
       $sales = new B2c_sales;
       $sales->plan_id= $request->plan_name;
       $sales->customer_id = $request->customer_name;
       $sales->invoice_number = $invoiceID;
       $sales->sale_amount= $request->sale_amount;
       $sales->sale_date= $request->sale_date;
       $sales->tax_amount= $request->tax_amount; 
       $sales->total_amount= $request->total_amount;
       $sales->number_of_days = $request->number_of_days;
       $sales->save();
       return redirect('b2csales')->with('success','B2c Sales Added Successfully');
   }


}
