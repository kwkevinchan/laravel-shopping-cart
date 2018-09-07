<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductClass;

class ProductClassController extends Controller
{
    public function index()
    {
        return view('product_class.index');
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
        $product_class = ProductClass::create([
            'name' => $request->name,
            'detail' => $request->detail,
        ]);
        session()->flash('status', 'success');
        session()->flash('message', '已新增類別:'. $request->name .' ！');
        return redirect('/product_class');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
