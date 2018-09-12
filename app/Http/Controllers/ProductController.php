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
        $company = Company::where('id', '=', $id)->first();
        if($request->name != $company->name){
            if(Company::where('name', '=', $request->name)->get()->toArray() != []){
                //重複名稱
                session()->flash('status', 'danger');
                session()->flash('message', '委託單位:'. $request->name .' 已存在！');
                return redirect('/company/' . $id . '/edit');
            } else {
                Company::where('id', '=', $id)->update(['name' => $request->name]);
                session()->flash('status', 'success');
                session()->flash('message', '已更新委託單位:'. $request->name .' ！');
                return redirect('/company');
            }
        } else {
            //同名但更新，為了刷新更新時間
            Company::where('id', '=', $id)->update(['name' => $request->name]);
            session()->flash('status', 'success');
            session()->flash('message', '已更新委託單位:'. $request->name .' ！');
            return redirect('/company');
        }
    }
}
