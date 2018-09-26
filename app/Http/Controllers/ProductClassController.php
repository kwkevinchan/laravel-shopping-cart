<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductClass;

class ProductClassController extends Controller
{
    public function index()
    {
        $product_class = ProductClass::get();
        // return dd($product_class);
        return view('product_class.index', [
            'product_class' => $product_class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return dd($request->request);

        if(ProductClass::where('name', '=', $request->name)->get()->toArray() != []){
            session()->flash('status', 'danger');
            session()->flash('message', '類別:'. $request->name .' 已存在！');
            return redirect('/productClass/create');
        }

        $product_class = ProductClass::create([
            'name' => $request->name,
            'detail' => $request->detail,
        ]);
        session()->flash('status', 'success');
        session()->flash('message', '已新增類別:'. $request->name .' ！');
        return redirect('/productClass');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_class = ProductClass::where('id', '=', $id)->first();
        // return dd($product_class);
        return view('product_class.edit', [
            'product_class' => $product_class,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product_class = ProductClass::where('id', '=', $id)->first();
        if($request->name != $product_class->name){
            if(ProductClass::where('name', '=', $request->name)->get()->toArray() != []){
                //重複名稱
                session()->flash('status', 'danger');
                session()->flash('message', '類別:'. $request->name .' 已存在！');
                return redirect('/productClass/' . $id . '/edit');
            } else {
                ProductClass::where('id', '=', $id)
                    ->update([
                        'name' => $request->name,
                        'detail' => $request->detail
                    ]);
                session()->flash('status', 'success');
                session()->flash('message', '已更新類別:'. $request->name .' ！');
                return redirect('/productClass');
            }
        } else {
            //同名但更新，為了刷新更新時間
            ProductClass::where('id', '=', $id)
                ->update([
                    'name' => $request->name,
                    'detail' => $request->detail
                ]);
            session()->flash('status', 'success');
            session()->flash('message', '已更新類別:'. $request->name .' ！');
            return redirect('/productClass');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_class = ProductClass::findOrFail($id);
        $product_class->delete();

        session()->flash('status', 'success');
        session()->flash('message', '已刪除類別:'. $product_class->name);
        return redirect('/productClass');
    }
}