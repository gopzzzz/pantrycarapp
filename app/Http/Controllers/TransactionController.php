<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Transactions;
use App\Models\Transaction_deleted_historys;

class TransactionController extends Controller
{
   public function transaction(){
    $account=DB::table('account_heads')->where('status','0')->get();
    $transaction=DB::table('transactions')
    ->leftjoin('account_heads', 'transactions.account_head_id', '=', 'account_heads.id')
    ->select('transactions.*','account_heads.head_name')
    ->orderby('transactions.id','desc')->get();
    return view('admin.transaction',compact('transaction','account'));
   }
   public function transactioninsert(Request $request)
   {
    $validatedData = $request->validate([
        'account_head' => 'required',            
        'remark' => 'required',            
        'amount' => 'required',            
        'title' => 'required',   
        'type' => 'required',            
         

    ]);
    
       $transaction = new Transactions;
       $transaction->account_head_id = $request->account_head;
       $transaction->remark = $request->remark;
       $transaction->title = $request->title;
       $transaction->amount = $request->amount;
       $transaction->type=$request->type;
       $transaction->save();
       return redirect('transaction')->with('success','Transaction Details Added Successfully');
   }
   public function transactiondelete($id, Request $request) {
   
    $transaction = Transactions::findOrFail($id);

    $deletedTransaction = new Transaction_deleted_historys;
    $deletedTransaction->account_head_id = $transaction->account_head_id;
    $deletedTransaction->transaction_id = $transaction->id;
    $deletedTransaction->remark = $transaction->remark; 
    $deletedTransaction->title = $transaction->title; 
    $deletedTransaction->amount = $transaction->amount; 
    $deletedTransaction->type =$transaction->type; 
    $deletedTransaction->save();
    $transaction->delete(); 
    return back()->with('success', 'Transaction Deleted and Stored in History Successfully');
}


}
