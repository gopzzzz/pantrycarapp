<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Account_heads;

class AccountheadController extends Controller
{
   public function account_head(){
    $account=DB::table('account_heads')->orderby('account_heads.id','desc')->get();
    return view('admin.account_head',compact('account'));
   }
   public function account_headinsert(Request $request)
   {
    $validatedData = $request->validate([
        'head_name' => 'required',            
     
    ]);
    
       $account = new Account_heads;
       $account->head_name = $request->head_name;
       $account->status = 0;
       $account->save();
       return redirect('account_head')->with('success','Account Head Details Added Successfully');
   }
   public function account_headfetch(Request $request){
    $id=$request->id;
    $account=Account_heads::find($id);
    print_r(json_encode($account));
   }
   public function account_headedit(Request $request)
   {
    $validatedData = $request->validate([
        'head_name' => 'required',            

    ]);
    
       $id=$request->id;
       $account=Account_heads::find($id);
       $account->head_name = $request->head_name;
       $account->status = $request->status;
       $account->save();
       return redirect('account_head')->with('success','Account Head Details Edited Successfully');

   }
   public function account_headdelete($id) {
    Account_heads::findOrFail($id);
    return back()->with('success', 'Account Head Deleted Successfully');
}



}
