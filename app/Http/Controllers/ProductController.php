<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','DESC')->get();
        return view('admin.view')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'title'=>'required',
        'price'=>'required',
        'description'=>'required',
        'quantity'=>'required',
        'image'=>'nullable|image|max:1999'
      ]);

      //file control
      if($request->hasFile('image')){
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileNameToSave = $fileName.'_'.time().'.'.$extension;
        $path = $request->file('image')->storeAs('public/product_images/',$fileNameToSave);
      }
      else{
        $fileNameToSave = 'noimage.jpg';
      }
      $product = new Product();
      $product->title = $request->input('title');
      $product->price = $request->input('price');
      $product->description = $request->input('description');
      $product->quantity = $request->input('quantity');
      $product->image = $fileNameToSave;
      $product->save();
      return redirect('/product/create')->with('success','Product Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return 12;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
      return view('admin.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
          'title'=>'required',
          'price'=>'required',
          'description'=>'required',
          'quantity'=>'required',
          'image'=>'nullable|image|max:1999'
        ]);

        //file control
        if($request->hasFile('image')){
          $fileNameWithExt = $request->file('image')->getClientOriginalName();
          $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('image')->getClientOriginalExtension();
          $fileNameToSave = $fileName.'_'.time().'.'.$extension;
          $path = $request->file('image')->storeAs('public/product_images/',$fileNameToSave);
        }

        $product = Product::find($product->id);
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        if($request->hasFile('image')){
          $product->image = $fileNameToSave;
        }
        $product->save();
        return redirect('/product')->with('success','Product Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
      $product = Product::find($product->id);
      if($product){
        if($product->delete()){
          Storage::delete('public/product_images/'.$product->image);
          return redirect('/product')->with('success','Successfully Deleted');
        }else{
          return redirect('/product')->with('error','Can not delete');
        }
      }else{
        return view('/product')->with('error','No product found');
      }

    }
}
