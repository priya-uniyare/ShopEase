<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        if (Auth::check() && Auth::user()->user_type == "user") {

            return view('dashboard');
        } else if (Auth::check() && Auth::user()->user_type == "admin") {
            return view('admin.dashboard');
        }
    }

    public function home()
    {
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
        } 
        else {
            $count='';
        }
        $products = Product::latest()->take(2)->get();
        return view('index', compact('products','count'));
    }


    public function productDetails($id) {
         if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
        } 
        else {
            $count='';
        }

        $product=Product::findOrFail($id);
        return view('product_details',compact('product','count'));
    }

    public function allProducts()
    {
         if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
        } 
        else {
            $count='';
        }
        $products = Product::all();
        return view('allproducts', compact('products','count'));
    }  


    public function addToCard($id)
    {
        $product=Product::findOrFail($id);
        $product_cart=new ProductCart();
        $product_cart->user_id=Auth::id();
        $product_cart->product_id=$product->id;
        $product_cart->save();
        return redirect()->back()->with('cart_message','added to the card');
    }


    public function cartProducts()
    {
        if (Auth::check()) {
            $cart = ProductCart::where('user_id', Auth::id())->get();
            $count = $cart->count();
        } else {
            $cart = collect(); 
            $count = 0;
        }
    
        return view('viewcartproduct', compact('cart', 'count'));
    }
    
     public function removeCartProducts($id)
     {
        $cart_product=ProductCart::findOrFail($id);
        $cart_product->delete();
        return redirect()->back();
     }

    public function confirmOrder(Request $request)
    {

        $cart_product_id = ProductCart::where('user_id', Auth::id())->get();
       
       $address=$request->address;
       $phone=$request->phone;
        foreach ($cart_product_id as $cart_product) {
            $order = new Order();
            $order->address = $address;
            $order->phone = $phone;
            $order->user_id = Auth::id();
            $order->product_id = $cart_product->product_id;
            $order->save();
        }


        $cart=ProductCart::where('user_id',Auth::id())->get();
        foreach($cart as $cart)
        {
           $cart_id=ProductCart::findOrFail($cart->id);
           $cart_id->delete();
        }
        
        return redirect()->back()->with('order_message','order Placed Successfully!!!');
    }

    public function myOrders()
    {

        $orders=Order::where('user_id',Auth::id())->get();
        return view('viewmyorder',compact('orders'));

    }
    }

