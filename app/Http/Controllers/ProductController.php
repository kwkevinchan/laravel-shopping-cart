<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Product;
use App\Models\ProductClass;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index()
    {
        $product = Product::where('user_id', Auth::id())->get();
        return view('product.index', [
            'product' => $product
        ]);
    }

    public function create()
    {
        $product_class = ProductClass::get()->chunk(3);
        // return dd($product_class);
        return view('product.create', [
            'product_class' => $product_class
        ]);
    }

    public function store(Request $request)
    {
        // return dd($request->request);
        $user_id = Auth::id();
        $all_class = '';

        if($request->product_calss){
            $all_class = implode('<|>', $request->product_calss);
        }

        Product::create([
            'user_id' => $user_id,
            'productclass_id' => $all_class,
            'name' => $request->name,
            'detail' => $request->detail,
            'price' => $request->price,
            'volume' => $request->volume
        ]);

        session()->flash('status', 'success');
        session()->flash('message', '已新增商品:'. $request->name .' ！<br/>售價:' . $request->price . '<br>存貨:' . $request->volume);
        return redirect('/product');
    }

    public function edit($id)
    {
        $product = Product::where('id', '=', $id)->first();
        if($product->productclass_id != null){
            $all_class = explode('<|>', $product->productclass_id);
        }
        $product_class = ProductClass::get()->chunk(3);
        return view('product.edit', [
            'product' => $product,
            'product_class' => $product_class,
            'all_class' => $all_class
        ]);
    }

    public function update(Request $request, $id)
    {
        // return dd($request->request);
        Product::where('id', '=', $id)->update([
            'name' => $request->name,
            'detail' => $request->detail,
            'productclass_id' => implode('<|>', $request->product_calss),
            'price' => $request->price,
            'volume' => $request->volume,
        ]);
        session()->flash('status', 'success');
        session()->flash('message', '已更新商品:'. $request->name .'！<br>現有數量:'. $request->volume);
        return redirect('/product/' . $id . '/edit');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        session()->flash('status', 'success');
        session()->flash('message', '已刪除商品:'. $product->name);
        return redirect('/product');
    }

}
