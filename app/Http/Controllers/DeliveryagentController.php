<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Delivery_boys;

class DeliveryagentController extends Controller
{
   public function delivery_agent(){
    $deliveryagent=DB::table('delivery_boys')->orderby('delivery_boys.id','desc')->get();
    return view('admin.delivery_agent',compact('deliveryagent'));
   }
   public function delivery_agentinsert(Request $request)
   {
    $validatedData = $request->validate([
        'delivery_agent_name' => 'required',            
        'address' => 'required',
        'phone_number' => 'required',
        'email' => 'required',
        'date_of_birth' => 'required',
        'photo' => 'required',
        'qualification' => 'required',
        'id_proof' => 'required',
    ]);
    
       $deliveryagent = new Delivery_boys;
       $deliveryagent->name = $request->delivery_agent_name;
       $deliveryagent->address = $request->address;
       $deliveryagent->phone_number= $request->phone_number;
       $deliveryagent->email= $request->email; 
       $deliveryagent->dob= $request->date_of_birth; 
       if($files=$request->file('photo')){  
        $name=$files->getClientOriginalName();  
        $files->move('img/',$name);  
        
        $deliveryagent->photo=$name; 
        
    }         $deliveryagent->qualification = $request->qualification;
       $deliveryagent->id_proof = $request->id_proof;
       $deliveryagent->save();
       return redirect('delivery_agent')->with('success','Delivery Agent Details Added Successfully');
   }
   public function delivery_agentfetch(Request $request){
    $id=$request->id;
    $deliveryagent=Delivery_boys::find($id);
    print_r(json_encode($deliveryagent));
   }
   public function delivery_agentedit(Request $request)
   {
    $validatedData = $request->validate([
        'delivery_agent_name' => 'required',            
        'address' => 'required',
        'contact_number' => 'required',
        'email' => 'required',
        'date_of_birth' => 'required',
        'qualification' => 'required',
        'id_proof' => 'required',
    ]);
    
       $id=$request->id;
       $deliveryagent=Delivery_boys::find($id);
       $deliveryagent->name = $request->delivery_agent_name;
       $deliveryagent->address = $request->address;
       $deliveryagent->phone_number= $request->contact_number;
       $deliveryagent->email= $request->email; 
       $deliveryagent->dob= $request->date_of_birth; 
       if($files=$request->file('photo')){  
        $name=$files->getClientOriginalName();  
        $files->move('img/',$name);  
        
        $deliveryagent->photo=$name; 
        
    }  
       $deliveryagent->qualification = $request->qualification;
       $deliveryagent->id_proof = $request->id_proof;
       $deliveryagent->save();
       return redirect('delivery_agent')->with('success','Delivery Agent Details Edited Successfully');

   }
   public function delivery_agentdelete($id){
    DB::delete('delete from delivery_boys where id = ?',[$id]);
    return back()->with('success', 'Delivery Agent Deleted Successfully');
}
}
