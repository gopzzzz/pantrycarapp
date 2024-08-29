<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Tbl_Enquirys; 
use Auth;

class EnquiryController extends Controller
{
    public function enquirylist(){
        $role = Auth::user()->user_type;
        $enquiry=DB::table('tbl_enquirys')
        ->leftjoin("tbl_products","tbl_enquirys.product_id","=","tbl_products.id")
        ->select("tbl_enquirys.*","tbl_products.product_name")
        ->orderby('tbl_enquirys.id','desc')
        ->get();
        return view("Enquiry.enquirylist", compact("role","enquiry"));
    }  
  
 
    
}