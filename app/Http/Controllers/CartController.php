<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    //

    public function cart()
    {
        return view('cart');
    }
    
    public function add_to_cart(Request $request)
    {
        if(session()->has('cart'))
        {

          
            $cart=session()->get('cart');
            $products_array_ids=array_column($cart,'id');

            $id=$request->input('id');

            if(!in_array($id,$products_array_ids))
            {
                $name=$request->input('name');
              //  dd($request->input('name'));
                $image=$request->input('image');
                $price=$request->input('price');
                $quantity=$request->input('quantity');
                $sale_price=$request->input('sale_price');

                if($sale_price!=null)
                {
                    $price_to_charge=$sale_price;
                }
                else
                {
                    $price_to_charge=$price;
                }

                $product_array=array(
                            'id'=>$id,
                            'name'=>$name,
                            'image'=>$image,
                            'price'=>$price_to_charge,
                            'quantity'=>$quantity
                );
                $cart[$id]=$product_array;
                session()->put('cart',$cart);

 
            }
            else
            {
                echo "<script>alert('product is already in the cart');</script>";
            }

            return view('cart');

        }
        else
        { 
                $cart=array();
                $id=$request->input('id');
                $name=$request->input('name');
                //dd($request->input('name'));
                $image=$request->input('image');
                $price=$request->input('price');
                $quantity=$request->input('quantity');
                $sale_price=$request->input('sale_price');

                if($sale_price!=null)
                {
                    $price_to_charge=$sale_price;
                }
                else
                {
                    $price_to_charge=$price;
                }

                $product_array=array(
                            'id'=>$id,
                            'name'=>$name,
                            'image'=>$image,
                            'price'=>$price_to_charge,
                            'quantity'=>$quantity
                );
                $cart[$id]=$product_array;

                session()->put('cart',$cart);
               
              
                return view('cart');
        }

    }
}
