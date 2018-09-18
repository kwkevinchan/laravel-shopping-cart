<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductClass;
use App\Models\Cart;
use App\User;
use Auth;


class ConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('product_classes')->get();
        $product_class = ProductClass::get();
        return view('consumer.index',[
            'product' => $product,
            'product_class' => $product_class
        ]);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->with(['product_classes', 'user'])->first();
        return view('consumer.show', [
            'product' => $product
        ]);
    }

    public function create(Request $request)
    {
        $product = Product::where('id', $request->id)->with(['product_classes', 'user'])->first();
        if($request->volume > $product->volume){
            session()->flash('status', 'danger');
            session()->flash('message', '此商品已售完!!');
            return redirect('/consumer/'.$request->id);
        }
        $user_id = Auth::id();
        $cart_create = Cart::create([
            'user_id' => $user_id,
            'product_id' => $request->id,
            'price' => $product->price,
            'volume' => $request->volume,
        ]);
        Product::where('id', $request->id)->update(['volume' => $product->volume - $request->volume]);

        session()->flash('status', 'success');
        session()->flash('message', '商品'. $product->name . ',' . $request->volume .'個已成功加入購物車!');
        session()->flash('id', $request->id);
        return redirect('/consumer/cart');
    }

    public function cart()
    {
        $cart = Cart::where('user_id', Auth::id())->with(['product'])->get();
        // return dd($cart);
        return view('consumer.cart', [
            'cart' => $cart
        ]);
    }

    public function remove($id)
    {
        $cart = Cart::with('product')->where('id', $id)->first();
        if($cart){
            Cart::where('id', $id)->delete();
            $volume = Product::where('id', $cart->product_id)->first(['volume']);
            Product::where('id', $cart->product_id)->update(['volume' => $volume->volume + $cart->volume]);
            session()->flash('status', 'success');
            session()->flash('message', '商品'. $cart->product->name . ',' . $cart->volume .'個已成功移除!');
            return redirect('/consumer/cart');
        } else {
            session()->flash('status', 'danger');
            session()->flash('message', '您所選取的商品不存在!');
            return redirect('/consumer/cart');
        }
    }
}
