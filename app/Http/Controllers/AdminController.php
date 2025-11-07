<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use  Barryvdh\DomPDF\Facade\Pdf;
use PhpParser\Node\Stmt\Catch_;

class AdminController extends Controller
{
    public function addCategory()
    {
        return view('admin.addcategory');
    }
  public function postaddcategory(Request $request)
  {
    $category = new Category();
    $category->category = $request->category;
    if ($category->save()) {
      return redirect()->back()->with('success', 'Category added successfully');
    } else {
      return redirect()->back()->with('error', 'Something went wrong! try some time later');
    }
  }


  public function viewCategory()
      {

        $categories=Category::all();
        return view('admin.viewcategory',compact('categories'));
        
      }

      public function deleteCategory($id)
      {
        $category=Category::find($id);
      if($category->delete())
      {
        return redirect()->back()->with('success','Category deleted successfully');
      }

      else
      {
        return redirect()->back()->with('fail','Something is wrong! ');
      }
      }

    public function updateCategory($id)
    {

      $category=Category::findOrFail($id);
      return view('admin.updatecategory',compact('category'));
    }

    public function postUpdateCategory(Request $request,$id)
    {
      $category=Category::findOrFail($id);
      $category->category=$request->category;
      $category->save();
      return back()->with('Category_updated_message','Category updated successfully!!'); 
    
    }
    public function addProduct()
    {

      $categories=Category::all();
      return view('admin.addproduct',compact('categories'));
    }

    public function postAddProduct(Request $request)
    {  

      $product=new Product();
      $product->product_title=$request->product_title;
      $product->product_description=$request->product_description;
      $product->product_quantity=$request->product_quantity;
      $product->product_price=$request->product_price;

     
      if($request->hasFile('product_image'))
      {
        $image=$request->file('product_image');
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('products'),$imagename);
        $product->product_image=$imagename;
      }
      $product->product_category=$request->product_category;
      $product->save();
      return redirect()->back()->with('added_product_message','Product added successfully!!!');  
    }

    public function viewProduct()
    {
      $products=Product::paginate(1);
      return view('admin.viewproduct',compact('products'));
    }

    public function deleteProduct($id)
    {
      $product=Product::find($id);
      $image_path=public_path('products/'.$product->product_image);
      if(file_exists($image_path))
      {
        unlink($image_path);
      }
      if($product->delete())
      {
        return redirect()->back()->with('delete_product_message','Product deleted successfully');
      }

    }
    public function updateProduct($id)
    {
      $product=Product::findOrFail($id);
      $categories=Category::all();
      return view('admin.updateprodcut',compact('product','categories'));
    }

    public function postUpdateProduct(Request $request,$id)
    {
      $product=Product::findOrFail($id);
      $product->product_title=$request->product_title;
      $product->product_description=$request->product_description;
      $product->product_quantity=$request->product_quantity; 
      $product->product_price=$request->product_price;

      if($request->hasFile('product_image'))
      {
        $image=$request->file('product_image');
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('products'),$imagename);
        $product->product_image=$imagename;

      }
      $product->product_category=$request->product_category;
      $product->save();
      return redirect()->back()->with('updated_product_message','Product Updated Successfully!!!!');
    }

    public function searchProduct(Request $request)
    {


      $products=Product::where('product_title','LIKE','%'.$request->search.'%')->orWhere('product_description','LIKE','%'.$request->search.'%')->orWhere('product_category','LIKE','%'.$request->search.'%')->paginate(1);
       return view('admin.viewproduct',compact('products'));

    }

    public function viewOrder()
    {
      $orders=Order::all();
      return view('admin.vieworders',compact('orders'));
    }

    public function changeStatus(Request $request,$id)
    {

      $order=Order::findOrFail($id);
      $order->status=$request->status;
      $order->save();
      return redirect()->back();

    }

    public function downloadPDF($id)
    {

      $data=order::findOrFail($id);
      $pdf = Pdf::loadView('admin.invoice',compact('data'));
     return $pdf->download('customer-order.pdf');
    }
 }
