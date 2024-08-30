<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Customers;

class CustomerController extends Controller
{
   public function customer(){
    $customer=DB::table('customers')->orderby('customers.id','desc')->get();
    return view('admin.customer',compact('customer'));
   }
   public function customerinsert(Request $request)
   {
    $validatedData = $request->validate([
        'customer_name' => 'required',            
        'customer_code' => 'required',
        'contact_number' => 'required',
        'home_location' => 'required',
        'office_location' => 'required',

    ]);
    
       $customer = new Customers;
       $customer->name = $request->customer_name;
       $customer->customer_code = $request->customer_code;
       $customer->contact_number= $request->contact_number;
       $customer->home_location= $request->home_location; 
       $customer->office_location = $request->office_location;
       $customer->status = 0;
       $customer->save();
       return redirect('customer')->with('success','Customer Details Added Successfully');
   }
   public function customerfetch(Request $request){
    $id=$request->id;
    $customer=Customers::find($id);
    print_r(json_encode($customer));
   }
   public function customeredit(Request $request)
   {
       $validatedData = $request->validate([
           'customer_name' => 'required',            
           'customer_code' => 'required',
           'contact' => 'required',
           'home_location' => 'required',
           'office_location' => 'required',

       ]);
       
       $id=$request->id;
       $customer=Customers::find($id);
       $customer->name = $request->customer_name;
       $customer->customer_code = $request->customer_code;
       $customer->contact_number= $request->contact;
       $customer->home_location= $request->home_location; 
       $customer->office_location = $request->office_location;
       $customer->status = $request->status;
       $customer->save();
       return redirect('customer')->with('success','Customer Details Edited Successfully');

   }
}
