<?php

namespace App\Http\Controllers;

use App\product;
use App\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $TypeProducts = TypeProduct::All();

        return view('product.create')->with('TypeProducts',$TypeProducts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        //validate
        $validatedData = Validator::make($request->all(),[
            'Name' => 'required',
            'Price' => 'required|max:999|min:1',
            'idTypeProduct' => 'required',
        ]);

        $validatedData->errors()->add('Name', 'Something is wrong with this field!');
        
        //get form
        $model = $request->all();

        //resource page
        $TypeProducts = TypeProduct::All();

        return Redirect('product/create')
                ->with('TypeProducts',$TypeProducts)
                ->withErrors($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }
}
