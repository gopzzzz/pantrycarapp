<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WebController extends Controller
{
   public function index(){
      $category=DB::table('tbl_categorys')->get();
    return view('web.index',compact('category'));
   }
   public function products($id){
    $productList=DB::table('tbl_products')->where('category_id',$id)->get();
    return view('web.products',compact('productList'));
   }
   public function productdetails($id){
      $productDetails=DB::table('tbl_products')->where('id',$id)->first();
    return view('web.productdetails',compact('productDetails'));
   }

}
