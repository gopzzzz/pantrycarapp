<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Tbl_categorys; 
use Auth;

class CategoryController extends Controller
{
    public function categorylist(){
        $role = Auth::user()->user_type;
        $category=DB::table('tbl_categorys')->orderby('tbl_categorys.id','desc')->get();
        return view("Category.categorylist", compact("role","category"));
    }  
    public function categoryinsert(){
        $role = Auth::user()->user_type;
        return view("Category.categoryinsert", compact("role"));
    }  
    public function categoryadd(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required',
            "images.*" => "required|image|mimes:jpeg,png,jpg,gif",

        ]);
        
        $category=new Tbl_categorys;
        if ($files = $request->file("image")) {
            $name = $files->getClientOriginalName();
            $files->move("market/", $name);
            $category->image = $name;
            $category->category_name=$request->category_name;
		    $category->status=0;
            $category->save();      
          }
       
        return redirect('categoryinsert')->with('success','Category Details Inserted Successfully');
    }
    public function categoryfetch(Request $request)
    {
        $id = $request->id;
        $category =Tbl_categorys::find($id);
        print_r(json_encode($category));
    }   
    public function categoryedit(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required',

        ]);
		$id=$request->id;
		$category=Tbl_categorys::find($id);
        if ($files = $request->file("image")) {
            $name = $files->getClientOriginalName();
            $files->move("market/", $name);
            $category->image = $name;           
        }  
        $category->category_name=$request->category_name;
        $category->status=$request->status;
        $category->save();   
		return redirect('categorylist')->with('success','Category Details Edited Successfully');
	}  
    
}