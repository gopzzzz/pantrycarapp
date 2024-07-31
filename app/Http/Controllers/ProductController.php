<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbl_productimages;
use App\Models\Tbl_products;
use DB;
use Auth;

class ProductController extends Controller
{
    public function productlist(){
        $role = Auth::user()->user_type;
        $category = DB::table("tbl_categorys")->get();
        $product=DB::table('tbl_products')
        ->leftjoin("tbl_categorys","tbl_products.category_id","=" ,"tbl_categorys.id")
        ->select("tbl_products.*","tbl_categorys.category_name")
        ->orderby('tbl_products.id','desc')->get();
        return view("Product.productlist", compact("role","product","category"));
    }  
    public function productinsert(){
        $role = Auth::user()->user_type;
        $category = DB::table("tbl_categorys")->get();
        return view("Product.productinsert", compact("role","category"));
    }  
    public function productadd(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'video_link' => 'required', 
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
        
        $product = new Tbl_products;
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->video_link = $request->video_link;
        $product->status = 0;
        $product->save();
        $product_id = $product->id;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move("market/", $imageName); 
        Tbl_productimages::create([
                    'product_id' => $product_id,
                    'images' => $imageName,
                ]);
            }
        }
    return redirect('productinsert')->with('success', 'Product details inserted successfully');
    }
    public function productfetch(Request $request)
    {
        $id = $request->id;
        $product =Tbl_products::find($id);
        print_r(json_encode($product));
    }   
    public function productedit(Request $request){
        $validatedData = $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'video_link' =>'required',
        ]);
		$id=$request->id;
		$product=Tbl_products::find($id);  
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->video_link = $request->video_link;
        $product->status = $request->status;
        $product->save();
		return redirect('productlist')->with('success','Product Details Edited Successfully');
	}  
    public function productimageinsert(Request $request)
    {
        $prod_id = $request->productid;
        $request->validate([
            "images.*" => "required|image|mimes:jpeg,png,jpg,gif",
        ]);

        foreach ($request->file("images") as $image) {
            $imageName = uniqid() . "." . $image->getClientOriginalExtension();
            $image->move("market", $imageName);

            Tbl_productimages::create([
                "product_id" => $prod_id,
                "images" => $imageName,
            ]);
        }
        return redirect()
            ->back()
            ->with("success", "Images added successfully.");
    }
    public function productimagefetch(Request $request)
    {
        $id = $request->prod_id;
        $market1 = DB::table("tbl_productimages")
            ->where("product_id", $id)
            ->get();
        print_r(json_encode($market1));
    }
    public function productimagedelete(Request $request)
    {
        $imageId = $request->image_id;
        $image = Tbl_productimages::find($imageId);

        if (!$image) {
            return response()->json([
                "success" => false,
                "message" => "Image not found.",
            ]);
        }

    
        $imagePath = public_path("market/" . $image->images);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $image->delete();
        return response()->json([
            "success" => true,
            "message" => "Image deleted successfully.",
        ]);
    }
}