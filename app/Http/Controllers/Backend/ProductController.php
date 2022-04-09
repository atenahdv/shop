<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::paginate(10);
        return view('admin.products.index',compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::with('childrenRecursive')->where('parent_id',null)->get();
        $brands=Brand::all();

        return view('admin.products.create',compact(['categories','brands']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateSKU(){
        $number=mt_rand(1000,99999);

        if($this->checkSKU($number)){
           return  $this->generateSKU();
        }
        return (string)$number;
    }
    public function checkSKU($number){
        return Product::where('sku',$number)->exists();
    }

    public function makeSlug($string)
    {
        $string=strtolower($string);
        $string=str_replace(['?','؟'],'',$string);
        return preg_replace('/\s+/u','-',trim($string));
    }

    public function store(Request $request)
    {
      $newproduct=new Product();
      $newproduct->title=$request->title;
      $newproduct->sku=$this->generateSKU();
      $newproduct->slug=$this->makeSlug($request->slug);
      $newproduct->status=$request->status;
      $newproduct->description=$request->description;
      $newproduct->price=$request->price;
      $newproduct->discount_price=$request->discount_price;
      $newproduct->category_id=$request->category_id;
      $newproduct->brand_id=$request->brand_id;
      $newproduct->user_id=1;
      $newproduct->save();
      $photos=explode(',',$request->input('photo_id')[0]);

      $newproduct->photos()->sync($photos);
        Session::flash('success','محصول مورد نظر با موفیقت ایجاد شد.');
        return redirect('/administrator/products');
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
        //
    }
}
