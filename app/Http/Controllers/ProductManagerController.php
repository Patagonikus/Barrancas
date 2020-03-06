<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Auth;


class ProductManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //check who is loged/ return if nobody is loged
        $logUser=Auth::user();
        if($logUser==null){
            return redirect('/login');
        }

        //return only the products created by this user
        $products = Product::where('user_id','=',$logUser->id)->paginate(10);
        $allProducts =Product::where('user_id','=',$logUser->id)->get();

        //return view to product manager
        return view('crud/product-manager')->with([
            'products'=>$products,
            'allProducts'=>$allProducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

        /**
     * Make product visible or hidden in shop show display
     *
     * @return \Illuminate\Http\Response
     */
    public function visible(Request $req)
    {
        $product = Product::find($req['id']);

        $product->active = (!($product->active));
        $product->save();

        return redirect('/crud/product-manager');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $product=Product::where('id',$id)->delete();

        return back()->with('success_message','Se ha eliminado el producto!');
    }
}
