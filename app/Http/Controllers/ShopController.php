<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::where('active','!=','0')->inRandomOrder()->paginate(9);

        $products = Product::where('active','!=','0')->paginate(9);
        $categories = Category::where('active','!=','0')->get();
        $selectedCategory=null;

        return view('shop')
            ->with([
                'products'=>$products,
                'categories'=>$categories,
                'selectedCategory'=>$selectedCategory,
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $product = Product::where('id',$id)->firstOrFail();
        $product = Product::where('id',$id)->firstOrFail();
        $mightAlsoLike = Product::where('id','!=',$id)->where('active','!=','0')->mightAlsoLike()->get();

        return view('product')->with([
                'product'=> $product,
                'mightAlsoLike'=> $mightAlsoLike,
            ]);
    }


        /**
     * Display the specified resource.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function filterByCategory($categoryId)
    {

        $selectedCategory=Category::where('id',$categoryId)->firstOrFail();
        $products=$selectedCategory->getProducts();
        $categories = Category::where('active','!=','0')->get();

        return view('shop')
            ->with([
                'products'=>$products,
                'categories'=>$categories,
                'selectedCategory'=>$selectedCategory,
            ]);

    }

        /**
     * Display the specified resource.
     *
     * @param  int  $price
     * @return \Illuminate\Http\Response
     */
    public function filterByPrice($minPrice, $maxPrice)
    {
        $products=Product::where('active','!=','0')->where('price','>=',$minPrice)->where('price','<=',$maxPrice)->paginate(9);
        $categories = Category::where('active','!=','0')->get();
        $selectedCategory=null;

        return view('shop')
            ->with([
                'products'=>$products,
                'categories'=>$categories,
                'selectedCategory'=>$selectedCategory,
            ]);

    }
    

}
