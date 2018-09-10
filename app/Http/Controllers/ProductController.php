<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {
        $product = Product::get();
        return view('product.index',[
            'product' => $product
        ]);
    }

    public function create()
    {
        return view('basic.company.create');
    }

    public function store(Request $request)
    {
        $check = Company::where('name', '=', $request->name)->get()->toArray();
        if(!empty($check)){
        session()->flash('status', 'danger');
            session()->flash('message', '委託單位:'. $request->name .' 已存在！');
            return redirect('/company/create');
        }

        Company::create([
            'name' => $request->name,
        ]);
        
        session()->flash('status', 'success');
        session()->flash('message', '已新增委託單位:'. $request->name .' ！');
        return redirect('/company');
    }

    public function edit($id)
    {
        $company = Company::where('id', '=', $id)->first();
        return view('basic.company.edit', [
            'company' => $company
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
